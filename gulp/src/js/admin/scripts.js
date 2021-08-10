import {
	AjaxRequest,
	showMessage
} from "../main";

export function scriptsStats() {
	const form = document.querySelector('.admin-system__stats-form');
	const datefrom = form.querySelector('#datefrom');
	const dateto = form.querySelector('#dateto');
	const links = document.querySelector('.links__output');
	const redirects = document.querySelector('.redirects__output');
	const rejections = document.querySelector('.rejections__output');
	const income = document.querySelector('.income__output');

	form.addEventListener('submit', (e) => {
		e.preventDefault();

		const request = new AjaxRequest('POST');
		request.send(new FormData(form))
			.then(result => {
				if (result.message) showMessage(result.message);
				if (result.datefrom) datefrom.value = result.datefrom;
				if (result.dateto) dateto.value = result.dateto;
				if (result.links) links.textContent = result.links;
				if (result.redirects) redirects.textContent = result.redirects;
				if (result.rejections) rejections.textContent = result.rejections;
				if (result.income) income.textContent = result.income;
			})
	})
}