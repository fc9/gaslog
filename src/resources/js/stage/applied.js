module.exports = {
    init: $ => {
        const state = {
            applied_at: $('[name="applied_at"]'),
            wrapper: $("#appliedAt")
        };

        if (state.applied_at.is(":checked")) {
            var value = $('[name="applied_at"]:checked').val();
            state.wrapper.show();
            setApplied(value);
        }

        state.applied_at.change(e => {
            setApplied(e.target.value);
        });

        function setApplied(value) {
            const scope = {
                inSchool: $("#appliedInSchool"),
                outSchool: $("#appliedOutSchool")
            };
            state.wrapper.slideDown("slow");
            switch (value) {
                case "SCHOOL":
                    scope.inSchool.show();
                    scope.outSchool.hide();
                    break;
                case "OUTSIDE":
                    scope.inSchool.hide();
                    scope.outSchool.show();
                    break;
                case "BOTH":
                    scope.inSchool.show();
                    scope.outSchool.show();
                    break;
            }
        }
    }
};
