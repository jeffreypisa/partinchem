/**
 * anchorScroll
 * 
 * Setup the anchor scrolling functionality.
 * 
 * @function
 * @since	1.0
 * @returns	{void}
 */

export const initAnchorScroll = () => {

    /**
     * Get all anchors in the document.
     * @type	{HTMLCollection}
     */
    const anchors = document.querySelectorAll('.js-anchor');

    /**
     * scrollTo
     * 
     * Makes the target of the href 
     * scroll into view.
     * 
     * @param 	{Event} event
     * @returns	{void}
     */
    const scrollTo = function scrollTo(event) {
        let el = this;
        if (el.hasAttribute('href')) {
            let hash = el.hash;
            let target = document.querySelector(hash);
            let y = target.getBoundingClientRect().top + window.pageYOffset;
            window.scrollTo({top: y, behavior: 'smooth'});    
            event.preventDefault();  
        }
    };

    /**
     * addScrollHandler
     * 
     * Binds the scrollTo function to
     * the anchor element.
     * 
     * @param 	{HTMLElement} anchor
     * @returns	{void}
     */
    const addScrollHandler = (anchor) => {
        anchor.addEventListener('click', scrollTo);
    };

    /**
     * Add click event to each anchor.
     */
    // Array.prototype.forEach.call([...anchors], addScrollHandler());
    [...anchors].forEach(addScrollHandler);

};