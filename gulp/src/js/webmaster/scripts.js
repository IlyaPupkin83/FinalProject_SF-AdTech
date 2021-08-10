import {
	AjaxRequest,
	showMessage
} from "../main";

export function scriptStats() {
	const form = document.querySelector('.webmaster-stats__form');
	const datefrom = form.querySelector('#datefrom');
	const dateto = form.querySelector('#dateto');
	const statsBlock = form.querySelector('.webmaster-stats__output');
	const statsName = form.querySelector('.webmaster-stats__offer-name');
	const statsRedirects = form.querySelector('#redirects');
	const statsCosts = form.querySelector('#costs');

	form.addEventListener('submit', (e) => {
		e.preventDefault();

		const request = new AjaxRequest('POST');
		request.send(new FormData(form))
			.then(
				result => {
					statsBlock.classList.add('webmaster-stats__output_show');
					showMessage(result.message);
					statsName.textContent = result.name;
					datefrom.value = result.datefrom;
					dateto.value = result.dateto;
					statsRedirects.textContent = result.redirects;
					statsCosts.textContent = `${result.costs}`;
				}
			)
	})
}