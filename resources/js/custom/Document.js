export class Document {
    init() {
        this.DocData();
        this.Switches();
        this.Accordion();
    }

    DocData() {
        $(document).ready(function () {
            $('.ready-view-btn').on('click', function () {
                $('.ready-view-table').slideToggle();
            });
        })
    }

    Switches() {
        $(document).ready(function () {
            var slider = $("#range"),
                output = $("#output");

            output.text(slider.val());

            slider.on("input", function () {
                output.text(slider.val());
            });
        })
    }

    Accordion() {
        $(document).ready(function () {
            // Handle click events for closet headers
            $('.accordion-header').click(function () {
                $(this).toggleClass('active').next('.accordion-content').slideToggle();
                $('.accordion-header').not(this).removeClass('active').next('.accordion-content').slideUp();
            });
        });
    }
}
