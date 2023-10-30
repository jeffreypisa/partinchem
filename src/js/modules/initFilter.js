import { initModal } from '../modules/initModal';
/**
 * initFilter
 * 
 * Setup filter logic
 * 
 * @function
 * @since	1.0
 * @returns	{void}
 */
 
export const initFilter = () => {

	const form = document.querySelector(".js-filter");
	if (!form) return;
	
	const results = form.querySelector( '.js-filter-ajax-results');
	let count = 0;
	let filterHasBeenReset = false;
	const loadMoreButton = form.elements.submit;
	const filterType = form.elements.type;
	const formElements = form.elements;
	const filterReset = form.querySelector('.js-reset');
	const filterToggle = form.querySelector('.js-filter-toggle');
	const filterCategories = form.querySelectorAll(".js-filter-category");

	const updateForm = (event) => {
		if (event.type === "submit") {
			event.preventDefault();
		}

		if (event.target.parentElement.parentElement.classList.contains("js-filter-group") && event.target.checked === false) {
			const activeChildren = event.target.parentElement.parentElement.parentElement.querySelectorAll(".checkbox-child");
			[...activeChildren].forEach((activeChild) => {
				activeChild.checked = false;
			});
		}

		if (form.querySelectorAll("input:checked").length === 0 && form.querySelector(".js-filter-search").value === "" ) {
			filterHasBeenReset = true;
		} 

		const paged = form.elements.paged;
		const offset = form.elements.offset;
		filterType.value = 'switch';
		if (paged) {
			paged.value = 2;
		}
		offset.value = 0;
		count++;
		form.classList.add('is-loading');

		const formData = new FormData(form);

		if (filterHasBeenReset === true ) {
			formData.append( 'reset', 'true' );
		}

		fetch(wp.ajax, {
			method: 'POST',
			body: formData
		})
		.then(response => {
			if (response.ok === true && response.status === 200) {
				return response;
			} else {
				throw new Error(response.statusText);
			}
		})
		.then(response => response.text())
		.then((response) => {
			results.innerHTML = response;
		})
		.finally(() => {
			const termsContainer = form.querySelector('.js-terms');
			if (termsContainer) {
				let terms = termsContainer.dataset.terms.split(',');
				updateSidebar(terms, event);
			} 

			if ( !filterHasBeenReset ) {
				checkSingleResult();
				checkOpenSubmenus();
				toggleCategories();
				mapActiveFilters(); 
				form.elements.posts_per_page.value = -1;
				if (event.type === "change") {
					toggleSubMenu(event);
				}
			} else {
				clearSidebar();
			}

			form.classList.remove('is-loading');
			initModal();
			filterHasBeenReset = false;
		})
		.catch(error => {
			console.error(error);
		});
		return count;		
	};
	
	const loadMore = (event) => {		
		const paged = form.elements.paged;
		const offset = form.elements.offset;
		offset.value = parseInt(offset.value) + 1;
		const maxNumPages = form.elements.max.value;
		const url = new URL(wp.ajax);
		const action = form.elements.action.value;
		url.search = `action=${action}`;
		filterType.value = 'load';
		const formData = new FormData(event.target);
		
		form.classList.add('is-loading');
				
		fetch(url, {
			method: 'POST',
			body: formData
		}) 
		.then(response => {
			if (response.ok === true && response.status === 200) {
				return response;
			} else {
				throw new Error(response.statusText);
			}
		})
		.then(response => response.text())
		.then((response) => {
			results.insertAdjacentHTML('beforeend', response);
			const pagedValue = parseInt(paged.value) + 1;
			paged.value = pagedValue;
			// if (parseInt(maxNumPages) < pagedValue ) {
			// 	loadMoreButton.classList.add('is-hidden');
			// }
		})
		.finally(() => {
			form.classList.remove('is-loading');
		})
		.catch(error => {
			console.log(error);
		});

		event.preventDefault();
		
	};

	const updateSidebar = (terms, event) => {
		const clickedCheckbox = event.target;
		if (clickedCheckbox.checked === true && clickedCheckbox.classList.contains('checkbox-parent')) {
			let clickedCategory = clickedCheckbox.parentElement.parentElement.parentElement.parentElement.parentElement;
			clickedCategory.classList.add('is-active-category');
			let categoryInputs = clickedCategory.querySelectorAll('.checkbox-parent');

			[...categoryInputs].forEach((categoryInput) => {
				if (!categoryInput.parentElement.parentElement.classList.contains('is-hidden')) {
					categoryInput.parentElement.parentElement.classList.add('is-hidden');
				}
				if (categoryInput === clickedCheckbox) {
					categoryInput.parentElement.parentElement.classList.remove('is-hidden');
				}
			});	
		} else if (clickedCheckbox.checked === true && clickedCheckbox.classList.contains('checkbox-child')) {
            let clickedSubCategory = clickedCheckbox.parentElement.parentElement.parentElement;
            clickedSubCategory.classList.add('is-active-subcategory');
            let categoryInputs = clickedSubCategory.querySelectorAll('.checkbox-child');

            [...categoryInputs].forEach((categoryInput) => {
                if (!categoryInput.parentElement.parentElement.classList.contains('is-hidden')) {
                    categoryInput.parentElement.parentElement.classList.add('is-hidden');
                }
                if (categoryInput === clickedCheckbox) {
                    categoryInput.parentElement.parentElement.classList.remove('is-hidden');
                }
            }); 
		} else if (clickedCheckbox.classList.contains('checkbox-parent')) {
			let clickedCategory = clickedCheckbox.parentElement.parentElement.parentElement.parentElement.parentElement;
			clickedCategory.classList.remove('is-active-category');
		} else {
			let clickedCategory = clickedCheckbox.parentElement.parentElement.parentElement;
			clickedCategory.classList.remove('is-active-subcategory');
		}


		[...formElements].forEach((formElement, index) => {
			if (formElement.type === 'checkbox') {
				if (!terms.includes(formElement.id)) {
					if (!formElement.parentElement.parentElement.classList.contains('is-hidden')) {
						formElement.parentElement.parentElement.classList.add('is-hidden');
					}
				} else {					
					if (formElement.classList.contains('checkbox-parent')) {
						if (formElement.parentElement.parentElement.classList.contains('is-hidden') && !formElement.parentElement.parentElement.parentElement.parentElement.parentElement.classList.contains('is-active-category')) {
							formElement.parentElement.parentElement.classList.remove('is-hidden');
						}
					} else {
						if (formElement.parentElement.parentElement.classList.contains('is-hidden') && !formElement.parentElement.parentElement.parentElement.classList.contains('is-active-subcategory')) {
							formElement.parentElement.parentElement.classList.remove('is-hidden');
						}
					}
				}
			}
		});
	}

	const checkSingleResult = () => {
		const singleResult = form.querySelector('.js-single-result');
		if (singleResult) { console.log('single result');
			[...formElements].forEach((formElement, index) => {
				if (formElement.checked === false && !formElement.parentElement.parentElement.classList.contains('is-hidden')) {
					formElement.parentElement.parentElement.classList.add('is-hidden');
				}
			});
		}
	}

	const resetFilter = (event) => {
		filterHasBeenReset = true;
		updateForm(event);
	}

	const clearSidebar = () => {
		const activeCheckboxes = form.querySelectorAll('input:checked');
		const hiddenInputs = form.querySelectorAll('.filter__input.is-hidden');
		const hiddenCategories = form.querySelectorAll('.filter__category.is-hidden');
		const openSubmenus = form.querySelectorAll(".filter__group.is-open");
		const searchInput = form.querySelector(".js-filter-search");
		const activeCategories = form.querySelectorAll('.is-active-category');
		const activeSubCategories = form.querySelectorAll('.is-active-subcategory');
		form.elements.posts_per_page.value = -1;

		if (activeCheckboxes) {
			[...activeCheckboxes].forEach(activeCheckbox => {
				activeCheckbox.checked = false;
			});
		} 

		if (openSubmenus) {
			[...openSubmenus].forEach(openSubmenu => {
				openSubmenu.classList.remove("is-open");
			});
		}

		if (hiddenInputs) {
			[...hiddenInputs].forEach(hiddenInput => {
				hiddenInput.classList.remove("is-hidden");
			});
		}

		if (hiddenCategories) {
			[...hiddenCategories].forEach(hiddenCategory => {
				hiddenCategory.classList.remove("is-hidden");
			});
		}

		if (searchInput) {
			searchInput.value = "";
		}

		if (activeCategories) {
			[...activeCategories].forEach((activeCategory) => {
				activeCategory.classList.remove('is-active-category');
			});
		}

		if (activeSubCategories) {
			[...activeSubCategories].forEach((activeSubCategory) => {
				activeSubCategory.classList.remove('is-active-subcategory');
			});
		}

	}

	/**
	 * 
	 * Map the active filters after a form update
	 */
	const mapActiveFilters = () => {
		const activeFilters = form.querySelectorAll(".js-active-filter");
		const filterField = document.querySelector('.gfield--filters');
		const activeFilterNames = [];

		if (activeFilters) {
			if (activeFilters.length === 1) {
				form.elements.posts_per_page.value = 0;
			}
			[...activeFilters].forEach((activeFilter) => {
				const activeFilterValue = activeFilter.innerHTML.replace(/<i.*i>/, '');
				activeFilterNames.push(activeFilterValue);

				activeFilter.addEventListener('click', () => {
					const activeID = activeFilter.dataset.id;

					if (activeID === '0') {
						form.querySelector(".js-filter-search").value = '';
					} else {
						const activeCheckbox = form.querySelector(`input[id="${activeID}"]`);
						activeCheckbox.checked = false;
	
						if (activeCheckbox.parentElement.parentElement.classList.contains("js-filter-group") && activeCheckbox.checked === false) {
							const activeChildren = activeCheckbox.parentElement.parentElement.parentElement.querySelectorAll(".checkbox-child");
							[...activeChildren].forEach((activeChild) => {
								activeChild.checked = false;
							});
							if (activeCheckbox.parentElement.parentElement.parentElement.classList.contains("is-open")) {
								activeCheckbox.parentElement.parentElement.parentElement.classList.remove("is-open");
							}
						}
						
						if (activeCheckbox.classList.contains('checkbox-parent')) {
							let clickedCategory = activeCheckbox.parentElement.parentElement.parentElement.parentElement.parentElement;
							clickedCategory.classList.remove('is-active-category');
						}

						if (activeCheckbox.classList.contains('checkbox-child')) {
							let clickedCategory = activeCheckbox.parentElement.parentElement.parentElement;
							clickedCategory.classList.remove('is-active-subcategory');
						}
						
					}

					var evt = new Event('change');
					form.dispatchEvent(evt);
					event.preventDefault();
				});

				return activeFilterNames;
			});
			if (filterField) {
				filterField.querySelector('input').value = activeFilterNames;
			}
		}
	}

	/**
	 * 
	 * Check redundand open subMenus after a form update and close them
	 */
	const checkOpenSubmenus = () => {
		const singleResult = form.querySelector('.js-single-result');
		const openSubmenus = form.querySelectorAll(".filter__group.is-open"); 
		const closedSubmenus = form.querySelectorAll(".filter__group:not(.is-open)")

		if (singleResult) { 
			console.log('single result');
			[...formElements].forEach((formElement, index) => {
				if (formElement.checked === false && !formElement.parentElement.parentElement.classList.contains('is-hidden')) {
					formElement.parentElement.parentElement.classList.add('is-hidden');
				}
			});
		}

		if (openSubmenus) {
			[...openSubmenus].forEach((openSubmenu) => {
				const parentCheckbox = openSubmenu.querySelector(".checkbox-parent");

				if (parentCheckbox && singleResult) {
					let checked = false;
					const childCheckboxes = openSubmenu.querySelectorAll(".checkbox-child");
					[...childCheckboxes].forEach((childCheckbox) => {
						if (childCheckbox.checked === true) {
							checked = true;
						} 
					});

					if (checked === false) {
						openSubmenu.classList.remove("is-open");
					}
				} else if (parentCheckbox) {
					let checked = false;
					let isHidden = true;
					const childCheckboxes = openSubmenu.querySelectorAll(".checkbox-child");
					[...childCheckboxes].forEach((childCheckbox) => {
						if (childCheckbox.checked === true) {
							checked = true;
						} 
						if (!childCheckbox.parentElement.parentElement.classList.contains('is-hidden')) {
							isHidden = false;
						}
					})
					
					if (checked === false && openSubmenu.classList.contains("is-open")) {
						openSubmenu.classList.remove("is-open");
					}

					if ( isHidden === false && !openSubmenu.classList.contains("is-open")) {
						openSubmenu.classList.add("is-open");	
					}
				}
			});
		}

		if (closedSubmenus) {
			[...closedSubmenus].forEach((closedSubmenu) => {
				const parentCheckbox = closedSubmenu.querySelector(".checkbox-parent");
				let isHidden = true;

				const childCheckboxes = closedSubmenu.querySelectorAll(".checkbox-child");
				[...childCheckboxes].forEach((childCheckbox) => {
					if (!childCheckbox.parentElement.parentElement.classList.contains('is-hidden')) {
						isHidden = false;
					}
				});
				
				if (isHidden === false && parentCheckbox.checked) {
					closedSubmenu.classList.add("is-open");	
				}
			});
		};
	
	}

	const toggleCategories = () => {
		[...filterCategories].forEach((filterCategory) => {
			const notHiddenCheckboxes = filterCategory.querySelectorAll(".filter__input:not(.is-hidden)");
			
			if (filterHasBeenReset) {
				if (filterCategory.classList.contains('is-hidden')) {
					filterCategory.classList.remove("is-hidden");
				}
			} else {
				if (notHiddenCheckboxes.length === 0) {
					if (!filterCategory.classList.contains("is-hidden")) {
						filterCategory.classList.add('is-hidden');
					}
				} else {
					if (filterCategory.classList.contains('is-hidden')) {
						filterCategory.classList.remove("is-hidden");
					}
				}
			}
		});
	}

	/**
	 * 
	 * Toggle the sub menu logic
	 */
	const toggleSubMenu = (event) => {
		if (!event) return;
		let subMenuContainer = event.target.parentElement.parentElement.parentElement;
		let subMenu = subMenuContainer.querySelector('.js-filter-subgroup');

		if (subMenu) {
			if (event.target.checked) {
				const checkedSubinputs = subMenu.querySelectorAll(".filter__input");
				let children = true;
				[...checkedSubinputs].forEach((checkedSubinput) => {
					if (checkedSubinput.classList.contains('is-hidden')) {
						children = false;
					}
				});
				if (children) {
					subMenuContainer.classList.add("is-open");
				} 
			} else {
				if (subMenuContainer.classList.contains("is-open")) {
					subMenuContainer.classList.remove("is-open");
					const checkedSubinputs = subMenu.querySelectorAll(".filter__input");
					[...checkedSubinputs].forEach( (checkedSubinput) => {
						checkedSubinput.checked = false;
					});
				}
			}
		}			
	}

	/**
	 * 
	 * Toggle mobile filter
	 */
	const toggleFilter = (event) => {
		document.body.classList.toggle('is-filter-open');
		event.preventDefault();
	}
	
	/**
	 * Add the event listeners
	 */
	form.addEventListener('change', updateForm);
	form.addEventListener('submit', updateForm);
	filterReset.addEventListener('click', resetFilter);
	filterToggle.addEventListener('click', toggleFilter);

}

