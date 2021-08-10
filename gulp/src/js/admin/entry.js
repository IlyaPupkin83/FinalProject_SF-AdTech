import {
	pageSystem,
	pageTematic,
	pageUsers
} from "./pages";

const systemBtn = document.querySelector('.admin-menu__system');
const usersBtn = document.querySelector('.admin-menu__users');
const tematicBtn = document.querySelector('.admin-menu__tematic');

systemBtn.addEventListener('click', () => {
	pageSystem();
})

usersBtn.addEventListener('click', () => {
	pageUsers();
})

tematicBtn.addEventListener('click', () => {
	pageTematic();
})