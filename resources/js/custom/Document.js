export class Document {
    init() {
        this.Switches();
        this.Accordion();
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
            $('.ready-view-btn').click(function (e) {
                e.preventDefault();
                $(this).closest('.accordion-header').toggleClass('active');
                $(this).closest('.accordion-header').next('.accordion-content').slideToggle();
            });

            $('.close-arrow').click(function () {
                const $header = $(this).closest('.accordion-header');
                const $content = $header.next('.accordion-content');
                $header.removeClass('active');
                $content.slideUp();
            });

        });
    }
}
