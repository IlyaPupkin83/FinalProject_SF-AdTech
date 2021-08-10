import {
	pageMyOffers,
	pageNewOffer,
	pageStats
} from "./pages";

const myOffersBtn = document.querySelector('.advertiser-menu__offers');
const newOfferBtn = document.querySelector('.advertiser-menu__new');
const statsBtn = document.querySelector('.advertiser-menu__statistic');

myOffersBtn.addEventListener('click', () => {
	pageMyOffers();
})

newOfferBtn.addEventListener('click', () => {
	pageNewOffer();
})

statsBtn.addEventListener('click', () => {
	pageStats();
})