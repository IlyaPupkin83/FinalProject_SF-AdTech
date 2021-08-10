import {
	AjaxRequest,
	FormMaster,
	Page
} from "../main";
import {
	scriptsNew,
	scriptsOffers,
	scriptStats
} from "./scripts";

export function pageMyOffers(animation = true) {
	const myOffersBody = new AjaxRequest('GET', '/advertiser/myoffers');
	myOffersBody.send()
		.then(result => {
			const page = new Page;
			page.render(result.body);
			page.scripts(scriptsOffers)
		})
}

export function pageNewOffer() {
	const newOfferBody = new AjaxRequest('GET', '/advertiser/newoffer');
	newOfferBody.send()
		.then(result => {
			const page = new Page;
			page.render(result.body);
			page.scripts(scriptsNew);

			FormMaster.prepareToAjax(pageMyOffers);
		})
}

export function pageStats() {
	const statsBody = new AjaxRequest('GET', '/advertiser/stats');
	statsBody.send()
		.then(result => {
			const page = new Page;
			page.render(result.body);
			page.scripts(scriptStats);
		})
}