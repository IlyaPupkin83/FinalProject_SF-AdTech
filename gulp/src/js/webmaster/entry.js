import {
	pageStats,
	pageSubscribe,
	pageSubscriptions
} from "./pages";

const subscriptionsBtn = document.querySelector('.webmaster-menu__subscriptions');
const subscribeBtn = document.querySelector('.webmaster-menu__subscribe');
const statsBtn = document.querySelector('.webmaster-menu__stats');

subscriptionsBtn.addEventListener('click', () => {
	pageSubscriptions(true);
})

subscribeBtn.addEventListener('click', () => {
	pageSubscribe('/webmaster/subscribe', true);
})

statsBtn.addEventListener('click', () => {
	pageStats(true);
})