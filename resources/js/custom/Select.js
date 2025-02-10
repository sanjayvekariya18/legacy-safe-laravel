export class Select {
    init() {
        this.SelectOne();
        this.SelectTwo();
        this.CreateAccountSelect();
        this.UserSelect();
        this.PlaceHolderColor();
    }
    SelectOne() {
        $("#js-select1").select2({
            closeOnSelect: true,
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "manager-select2"
        });

        $(".select2-search").append('<span class="custom-span-placeholder">(Please select)</span>');

        $("#js-select1").on("select2:select", function () {
            if ($(".select2-selection__choice").length > 0) {
                $(".select2-container--open .select2-search__field").val("");
                $(".select2-container--open .select2-search__field").attr("placeholder", "");
                $(".custom-span-placeholder").text('');
            }
        });

        $("#js-select1").on("select2:open", function () {
            if ($(".select2-selection__choice").length > 0) {
                $(".select2-container--open .select2-search__field").val("");
            } else {
                $(".select2-container--open .select2-search__field").attr("placeholder", "Start typing...");
                $(".custom-span-placeholder").text('');
            }
        });

        $("#js-select1").on("select2:close", function () {
            if ($(".select2-selection__choice").length === 0) {
                $(".select2-search__field").attr("placeholder", "Client Name (Please select)");
                $(".custom-span-placeholder").text('(Please select)');
            }
        });
    }
    SelectTwo() {
        $(document).ready(function () {
            $("#js-select2").select2({
                closeOnSelect: false,
                allowClear: false,
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "manager-check-select2"
            });
                $(".select2-search").append('<span class="custom-span-placeholder">(Please select)</span>');


            $("#js-select2").on("select2:select", function () {
                if ($(".select2-selection__choice").length > 0) {
                    $(".select2-container--open .select2-search__field").val("");
                    $(".select2-container--open .select2-search__field").attr("placeholder", "");
                    $(".custom-span-placeholder").text('');
                }
            });

            $("#js-select2").on("select2:open", function () {
                if ($(".select2-selection__choice").length > 0) {
                    $(".select2-container--open .select2-search__field").val("");
                } else {
                    $(".select2-container--open .select2-search__field").attr("placeholder", "Start typing...");
                $(".custom-span-placeholder").text('');

                }
            });

            $("#js-select2").on("select2:close", function () {
                if ($(".select2-selection__choice").length === 0) {
                    $(".select2-search__field").attr("placeholder", "Select Users");
                    $(".custom-span-placeholder").text('(Please select)');

                }
            });
        });
    }
    CreateAccountSelect() {
        $(document).ready(function () {
            $("#js-select3").select2({
                closeOnSelect: true,
                allowClear: false,
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "user-select2"
            });
        });

    }
    UserSelect() {
        $("#js-select4").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "user-select2",
            dropdownParent: $('#invite-user')
        });

        $("#js-select5").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "user-select2",
            dropdownParent: $('#invite-user-modal')
        });
    }

    PlaceHolderColor() {
        $('.legacy-select').each(function () {
            let placeholderText = $(this).attr('data-placeholder');
            $(this).select2({
                placeholder: placeholderText,
                allowClear: true
            });
        });

        function stylePlaceholders() {
            setTimeout(function () {
                $('.select2-selection__placeholder').each(
                    function () {
                        let text = $(this).text();
                        let modifiedText = text.replace(/\((.*?)\)/, '<span class="placeholder-color">$&</span>');
                        $(this).html(modifiedText).addClass('placeholder-custom');
                    });
            }, 10);
        }




        $('.legacy-select').on('select2:open select2:clear', function () { stylePlaceholders(); }); stylePlaceholders();
    }
}
