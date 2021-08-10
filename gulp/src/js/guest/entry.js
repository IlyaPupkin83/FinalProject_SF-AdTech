import {
	AjaxRequest,
	Modal
} from '../main';
import {
	sectionRegistry
} from './registry';


const menuCap = document.querySelector('.menu__cap');
const authBtn = document.querySelector('.guest-menu__auth');
const registryBtn = document.querySelector('.guest-menu__registry');

menuCap.classList.add('menu__cap_flashing');
menuCap.addEventListener('mousemove', () => {
	menuCap.classList.remove('menu__cap_flashing');
}, {
	once: true
});

authBtn.addEventListener('click', () => {
	const auth = new AjaxRequest('GET', '/auth');
	auth.send()
		.then(
			result => {
				const modal = new Modal(result.body);
				modal.render();
			}
		)
})

registryBtn.addEventListener('click', () => {
	const auth = new AjaxRequest('GET', '/registry');
	auth.send()
		.then(
			result => {
				const modal = new Modal(result.body);
				modal.render();
				sectionRegistry();
			}
		)
})