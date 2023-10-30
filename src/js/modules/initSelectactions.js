/**
 * initSelectActions
 * 
 * Set logic for select download button on product single page
 *
 * 
 * @function
 * @since	1.0
 * @returns	{void}
 */

export const initSelectActions = () => {

    const selectField = document.querySelector('select');
    if (!selectField) return;

    function calculateTextPosition() {
        const selectWidth = selectField.offsetWidth - 32;
        const selectCenter = selectWidth / 2;
        const value = selectField.options[selectField.selectedIndex].innerHTML;

        const textElement = document.createElement("span");
        textElement.id = "selected-element"; 
        textElement.display = "none";
        textElement.innerHTML = value;
        document.body.appendChild(textElement);



        const createdElement = document.getElementById('selected-element');

        if (createdElement) {
            const textElementWidth = createdElement.offsetWidth;
            selectField.style.textIndent = selectCenter - (textElementWidth / 2) - 16 + "px";
            document.body.removeChild(createdElement);
        }

        
    }

    function downloadFile() {

        const value = selectField.options[selectField.selectedIndex].innerHTML;                
        let a = document.createElement("a");
        document.body.appendChild(a);
        a.style = "display: none";
        a.href = this.value;
        a.download = value;
        a.click();
        document.body.removeChild(a);
    }

    calculateTextPosition();

    selectField.addEventListener('change', calculateTextPosition);
    selectField.addEventListener('change', downloadFile);
    
}
