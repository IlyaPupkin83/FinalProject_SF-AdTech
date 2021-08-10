import {
	AjaxRequest,
	FormMaster,
	Page
} from "../main";
import {
	scriptsStats
} from "./scripts";

export function pageSystem() {
	const systemBody = new AjaxRequest('GET', '/admin/system');
	systemBody.send()
		.then(result => {
			const page = new Page;
			page.render(result.body);
			page.scripts(scriptsStats);
		})
}

export function pageUsers() {
	const usersBody = new AjaxRequest('GET', '/admin/users');
	usersBody.send()
		.then(result => {
			const page = new Page;
			page.render(result.body);

			FormMaster.prepareToAjax(pageUsers);
		})
}

export function pageTematic() {
	const tematicBody = new AjaxRequest('GET', '/admin/tematic');
	tematicBody.send()
		.then(result => {
			const page = new Page;
			page.render(result.body);

			FormMaster.prepareToAjax(pageTematic);
		})
}