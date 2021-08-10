import {
	AjaxRequest,
	showMessage
} from "../main";

export function sectionRegistry() {
	const regForm = document.querySelector('.registryform');

	regForm.addEventListener('submit', (e) => {
		e.preventDefault();

		const request = new AjaxRequest('POST');
		request.send(new FormData(regForm))
			.then(
				result => {
					showMessage(result.message);
				})
	})
}