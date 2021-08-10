const messageBlock = document.querySelector('.header__message');
const content = document.querySelector('.content');
const menu = content.querySelector('.content__menu');
const page = content.querySelector('.content__page');

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}

content.addEventListener('click', (e) => {
	if (e.target.classList.contains('menu__cap')) {
		menu.classList.add('content__menu_open');
	} else {
		menu.classList.remove('content__menu_open');
	}
})

messageBlock.addEventListener('animationend', () => {
	messageBlock.textContent = '';
})

export function showMessage(message) {
	if (message) messageBlock.textContent = message;
}

export class AjaxRequest {
	constructor(method, link = '/') {
		this.ajax = new XMLHttpRequest();
		this.ajax.open(method, link);
		this.ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	}

	send(body = null) {
		return new Promise((resolve, reject) => {
			this.ajax.send(body);
			this.ajax.onreadystatechange = () => {
				if (this.ajax.readyState === 4) {
					if (this.ajax.status === 200) {
						if (this.ajax.responseText) {
							resolve(JSON.parse(this.ajax.responseText))
						} else {
							resolve(true);
						}
					} else {
						reject(this.ajax);
					}
				}
			}
		})
	}
}

export class Modal {
	constructor(body) {
		this.modal = document.createElement('div');
		this.modal.className = 'modal';
		this.modal.innerHTML = body;

		this.modal.addEventListener('click', (e) => {
			e.stopPropagation();
		})


		const modalClose = document.createElement('div');
		modalClose.className = 'modal__close';
		modalClose.innerHTML = '×';
		modalClose.addEventListener('click', () => {
			this.modal.remove();
		})
		this.modal.appendChild(modalClose);

	}

	render() {
		document.querySelector('.container').appendChild(this.modal);
	}
}

export class Page {
	render(body, animation = false) {
		if (animation) {
			const gradient = document.createElement('div');
			gradient.className = 'content__animate';
			gradient.addEventListener('animationend', () => gradient.remove());
			content.appendChild(gradient);
		}

		while (page.firstChild) {
			page.removeChild(page.lastChild);
		}
		page.innerHTML = body;
	}

	scripts(functions) {
		function run(func) {
			if (typeof func === 'function') func();
		}
		if (Array.isArray(functions)) {
			functions.forEach(func => {
				run(func);
			})
		} else {
			run(functions);
		}
	}
}

export class FormMaster {

	static prepareToAjax(evalFunction) {
		[...page.querySelectorAll('form[method="POST"]')].forEach((form) => {

			form.addEventListener('submit', (e) => {
				e.preventDefault();
				const request = new AjaxRequest('POST');
				request.send(new FormData(form))
					.then(result => {
						if (result.message) showMessage(result.message);
						evalFunction();

					})
			})
		})
	}
}