/**
 * initModal
 *
 * Initialize modal functionality for the popup modal
 *
 * @function
 * @since	1.0
 *
 * @returns	{Array}
 */


export const initModal = function initModal() {

    const modal = document.querySelector('.js-modal');
    if (!modal) return;

    /**
     * Get all the toggles that open the modal
     * @type	{NodeList}
     */
    const modalOpen = document.querySelector('.js-open-modal');

    /**
     * toggleModal
     *
     * Open or close the modal
     *
     * @function
     * @since	1.0
     *
     * @returns	{void}
     */
    const openModal = function openModal() {
        event.preventDefault();
        if (!document.body.classList.contains('is-modal-open')) {
            document.body.classList.add('is-modal-open');
        }
    };

    /**
     * addEventListener
     *
     */
    modalOpen.addEventListener('click', openModal);
    
    // Close modal on outside click
    modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target.classList.contains('js-modal-close')) {
            if (document.body.classList.contains('is-modal-open')) {
                document.body.classList.remove('is-modal-open');
            }
        }
    });

    // Close modal on ESC key click
    document.onkeydown = () => {
        let evt = evt || window.event;
        if ("key" in evt) {
            if (evt.key === "Escape" || evt.key === "Esc") {
                if (document.body.classList.contains('is-modal-open')) {
                    document.body.classList.remove('is-modal-open');
                }
            }
        } 
    };
    
};