import {
	AjaxRequest,
	showMessage
} from "../main";
import {
	pageMyOffers
} from "./pages";

export function scriptsOffers() {
	const enableZone = document.querySelector('.advertiser-offers__enable');
	const disableZone = document.querySelector('.advertiser-offers__disable');

	let draggedOffer;
	const csrf = document.querySelector('#csrf').value;

	function requestMove(route) {
		const formData = new FormData();
		formData.append('route', route);
		formData.append('id', draggedOffer);
		formData.append('csrf', csrf);

		const request = new AjaxRequest('POST');
		request.send(formData)
			.then(result => {
				if (result.message) showMessage(result.message);
				pageMyOffers(false);
			})
	}

	function forDrag() {
		enableZone.addEventListener('dragover', (e) => {
			e.preventDefault();
		})

		disableZone.addEventListener('dragover', (e) => {
			e.preventDefault();
		})

		enableZone.addEventListener('drop', () => {
			requestMove('advertiser/offers/enable');
		})

		disableZone.addEventListener('drop', () => {
			requestMove('advertiser/offers/disable');
		})

		document.querySelectorAll('.list__offer').forEach(offer => {
			offer.addEventListener('dragstart', () => {
				draggedOffer = offer.querySelector('#offerId').value;
			})
		})
	}

	function forTouch() {
		let startClientX;
		let startClientY;

		document.querySelectorAll('.list__offer').forEach(offer => {
			offer.addEventListener('touchstart', (e) => {
				draggedOffer = offer.querySelector('#offerId').value;
				startClientX = e.changedTouches[0].clientX;
				startClientY = e.changedTouches[0].clientY;
			})
		})

		enableZone.addEventListener('touchend', (e) => {
			const endClientX = e.changedTouches[0].clientX;
			const endClientY = e.changedTouches[0].clientY;

			if (draggedOffer !== null && ((endClientX - startClientX) > 30) && (Math.abs(startClientY - endClientY) <= 30)) {
				requestMove('advertiser/offers/disable');
				draggedOffer = null;
			}

		})

		disableZone.addEventListener('touchend', (e) => {
			const endClientX = e.changedTouches[0].clientX;
			const endClientY = e.changedTouches[0].clientY;

			if (draggedOffer !== null && ((endClientX - startClientX) > 30) && (Math.abs(startClientY - endClientY) <= 30)) {
				requestMove('advertiser/offers/enable');
				draggedOffer = null;
			}
		})
	}

	if ('ondragover' in document) forDrag();
	if ('ontouchstart' in document) forTouch();

}

export function scriptsNew() {
	const inputFile = document.querySelector('.image__button');
	const nameFile = document.querySelector('.label__filename');

	inputFile.addEventListener('change', () => {
		const name = inputFile.files[0].name;
		nameFile.textContent = name;
	})
}

export function scriptStats() {
	const form = document.querySelector('.advertiser-stats__form');
	const datefrom = form.querySelector('#datefrom');
	const dateto = form.querySelector('#dateto');
	const statsBlock = form.querySelector('.advertiser-stats__output');
	const statsName = form.querySelector('.advertiser-stats__offer-name');
	const statsRedirects = form.querySelector('#redirects');
	const statsCosts = form.querySelector('#costs');

	form.addEventListener('submit', (e) => {
		e.preventDefault();

		const request = new AjaxRequest('POST');
		request.send(new FormData(form))
			.then(
				result => {
					statsBlock.classList.add('advertiser-stats__output_show');
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