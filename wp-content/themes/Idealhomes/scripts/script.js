$(document).ready(function () {
  $("#trendingProjectSlider").owlCarousel({
    loop: false,
    margin: 10,
    slideBy: 4,
    nav: true,
    navText: [
      "<i class='bi bi-chevron-left'></i>",
      "<i class='bi bi-chevron-right'></i>",
    ],
    autoplay: false,
    responsive: {
      0: {
        items: 1,
        //stagePadding: 70,
        nav: false,
      },
      600: {
        items: 2,
        stagePadding: 15,
        nav: false,
      },
      1000: {
        items: 4,
      },
    },
  });

  $("#leadingDevelopersSlider").owlCarousel({
    loop: false,
    margin: 10,
    slideBy: 6,
    nav: true,
    navText: [
      "<i class='bi bi-chevron-left'></i>",
      "<i class='bi bi-chevron-right'></i>",
    ],
    autoplay: false,
    responsive: {
      0: {
        items: 1,
        //stagePadding: 70,
        nav: false,
      },
      600: {
        items: 2,
        stagePadding: 15,
        nav: false,
      },
      1000: {
        items: 6,
      },
    },
  });

  $("#featuredCitiesSlider").owlCarousel({
    loop: false,
    margin: 10,
    slideBy: 4,
    nav: true,
    navText: [
      "<i class='bi bi-chevron-left'></i>",
      "<i class='bi bi-chevron-right'></i>",
    ],
    autoplay: false,
    responsive: {
      0: {
        items: 1,
        //stagePadding: 70,
        nav: false,
      },
      600: {
        items: 2,
        stagePadding: 15,
        nav: false,
      },
      1000: {
        items: 4,
      },
    },
  });

  class ReadMore extends HTMLElement {
    constructor() {
      super();
      this.originalHTML = this.innerHTML;
      this.originalTextContent = this.textContent;
    }

    static get observedAttributes() {
      return ["limit", "open"];
    }

    get less() {
      return this.getAttribute("less") || "Read Less";
    }

    get more() {
      return this.getAttribute("more") || "Read More";
    }

    get limit() {
      return this.hasAttribute("limit")
        ? Number(this.getAttribute("limit"))
        : 125;
    }

    get isOpen() {
      return this.hasAttribute("open");
    }

    attributeChangedCallback(name, oldVal, newVal) {
      this.render();
    }

    connectedCallback() {
      this.render();
    }

    render() {
      // Remove any existing "Read More" text from the original content
      const cleanedTextContent = this.originalTextContent
        .replace(/Read More$/, "")
        .trim();

      if (cleanedTextContent.length > this.limit) {
        if (!this.isOpen) {
          // Closed
          this.innerHTML = `
                  <p>
                    ${cleanedTextContent.slice(0, this.limit)}&hellip;
                    <a class="readMore">${this.more}</a>
                  </p>
                `;
        } else {
          // Open
          this.innerHTML = this.originalHTML;
          this.querySelector("p:last-child").innerHTML = `
                  ${this.querySelector("p:last-child").innerHTML.replace(
                    /<a class="readMore">.*?<\/a>/g,
                    ""
                  )}
                  <a class="readMore">${this.less}</a>
                `;
        }

        this.querySelector("a.readMore").addEventListener(
          "click",
          this.toggle.bind(this)
        );
      }
    }

    toggle(event) {
      event.preventDefault();
      this.toggleAttribute("open");
    }
  }

  customElements.define("read-more", ReadMore);

  $(".show-more").click(function () {
    const $this = $(this);
    const $text = $this.siblings(".text");
    $text.toggleClass("show-more-height");
    $this.text($text.hasClass("show-more-height") ? "Read More" : "Read Less");
  });

  // Event listener for checkbox change
  $('input[type="checkbox"]').change(function () {
    // Get all selected checkboxes
    var selectedFilters = $('input[type="checkbox"]:checked')
      .map(function () {
        return $(this).val().toLowerCase().replace(" ", "");
      })
      .get();

    // Show all project listings if no filter is selected
    if (selectedFilters.length === 0) {
      $(".project-grid").show();
    } else {
      // Hide all project listings
      $(".project-grid").hide();

      // Show project listings that match the selected filters
      selectedFilters.forEach(function (filter) {
        $('.project-grid[data-type="' + filter + '"]').show();
      });
    }
  });

  
  document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let isValid = true;

    // Validation rules
    const validationRules = [
      {
        id: 'name',
        errorClass: 'name-error',
        rules: [
          {
            test: value => value !== '',
            message: 'Name is required'
          }
        ]
      },
      {
        id: 'mobile',
        errorClass: 'mobile-error',
        rules: [
          {
            test: value => value !== '',
            message: 'Phone number is required'
          }
        ]
      },
      {
        id: 'email',
        errorClass: 'email-error',
        rules: [
          {
            test: value => value !== '',
            message: 'Email is required'
          },
          {
            test: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
            message: 'Invalid email format'
          }
        ]
      },
      {
        id: 'message',
        errorClass: 'message-error',
        rules: [
          {
            test: value => value !== '',
            message: 'Message is required'
          }
        ]
      }
    ];

    // Validate each field
    validationRules.forEach(field => {
      const value = document.getElementById(field.id).value;
      const errorElement = document.querySelector(`.${field.errorClass}`);
      const errorMessages = field.rules
        .filter(rule => !rule.test(value))
        .map(rule => rule.message);

      if (errorMessages.length > 0) {
        errorElement.textContent = errorMessages[0];
        isValid = false;
      } else {
        errorElement.textContent = '';
      }
    });

    if (isValid) {
      // Submit the form if all validations pass
      this.submit();
    }
  });

});
