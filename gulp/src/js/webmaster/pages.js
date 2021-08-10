import {
	AjaxRequest,
	FormMaster,
	Page
} from "../main";
import {
	scriptStats
} from "./scripts";

export function pageSubscriptions(animation = false) {
	const subscriptionsBody = new AjaxRequest('GET', '/webmaster/subscriptions');
	subscriptionsBody.send()
		.then(
			result => {
				const page = new Page;
				page.render(result.body, animation);

				FormMaster.prepareToAjax(pageSubscriptions);
			}
		)
}


export function pageSubscribe(uri = '/webmaster/subscribe', animation = false) {

	const subscribeBody = new AjaxRequest('GET', uri);
	subscribeBody.send()
		.then(
			result => {
				const page = new Page;
				page.render(result.body, animation);

				const tematicForm = document.querySelector('.webmaster-subscribe__tematics');

				if (tematicForm) {
					tematicForm.addEventListener('submit', (e) => {
						e.preventDefault();
						const get = new URLSearchParams;
						const formData = new FormData(tematicForm);
						if (formData.has('tematic')) get.append('tematic', formData.get('tematic'));
						const uri = `/webmaster/subscribe?${get.toString()}`;
						pageSubscribe(uri, false);
					})
				}

				FormMaster.prepareToAjax();
			}
		)
}

export function pageStats(animation = false) {
	const statsBody = new AjaxRequest('GET', '/webmaster/stats');
	statsBody.send()
		.then(
			result => {
				const page = new Page;
				page.render(result.body, animation);
				page.scripts(scriptStats);
			}
		)
}