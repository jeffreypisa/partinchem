/**
 * initAccordion
 * 
 * Setup accordion logic
 * 
*/

export const initAccordion = () => {

    /**
    * Get the accordion element
    // * @type	{HTMLElement}
    */
   const accordion = document.querySelectorAll('.js-accordion');
   let i;

   if (accordion.length < 1) return false;

   const togglePanel = function togglePanel() {
        this.classList.toggle("is-active");
        if (this.getAttribute('aria-expanded') === 'false' ) {
            this.setAttribute('aria-expanded', 'true');
        } else {
            this.setAttribute('aria-expanded', 'false');
        }
        let panel = this.nextElementSibling;
        if (panel.style.height) {
            panel.style.height = null;
        } else {
            panel.style.height = panel.scrollHeight + "px";
        }
        panel.addEventListener('transitionend', () => {
            panel.style.height = "initial";
        })
   };
   
   const toggleFirstPanel = function toggleFirstPanel(target) {
        target.classList.toggle("is-active");
        if (target.getAttribute('aria-expanded') === 'false' ) {
            target.setAttribute('aria-expanded', 'true');
        } else {
            target.setAttribute('aria-expanded', 'false');
        }
        let panel = target.nextElementSibling;
        if (panel.style.height) {
            panel.style.height = null;
        } else {
            panel.style.height = panel.scrollHeight + "px";
        }
        panel.addEventListener('transitionend', () => {
            panel.style.height = "initial";
        })
   };

    /**
    * Add click event to each accordion.
    */
   [...accordion].forEach(accordionItem => accordionItem.addEventListener("click", togglePanel));

    // for (i = 0; i < accordion.length; i++) {
    //     accordion[i].addEventListener("click", togglePanel);
    // }


    toggleFirstPanel(accordion[0]);
    // toggleFirstPanel(accordion[accordion.length - 1]);
};
