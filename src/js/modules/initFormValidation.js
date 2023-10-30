/**
 * initFormValidation
 * 
 * Setup focus effect on input elements
 * with an absolute positioned label behind it.
 * 
 * @function
 * @since	1.0
 * @returns	{void}
 */
export const initFormValidation = () => {

    const gravityForms = document.querySelectorAll('.gform--stock');

    if (gravityForms) {

        const checkHiddenField = function checkHiddenField() {
            const hiddenFieldContainer = this.querySelector('.gform_validation_container');
            if (hiddenFieldContainer) {
                const hiddenField = hiddenFieldContainer.querySelector('input');
                if (hiddenField.value !== '') {
                    console.log('Validation failed');
                    event.preventDefault();
                }
            }
        };
    
        [...gravityForms].forEach((gravityForm) => {
            gravityForm.addEventListener('submit', checkHiddenField);
        });

        // const addButtonLoad = function addButtonLoad() {
        //     const submitButtons = document.querySelectorAll(".gform_button");

        //     [...submitButtons].forEach((submitButton) => {
        //         submitButton.addEventListener('click', () => {
        //             submitButton.classList.add('is-loading');
        //             setTimeout( () => {
        //                 submitButton.classList.remove('is-loading');
        //                 addButtonLoad();
        //             },5000);            
        //         })
        //     });
        // }

        // addButtonLoad();
    }

}