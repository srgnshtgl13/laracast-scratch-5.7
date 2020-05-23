export default class Gate {
	constructor(user=""){
		this.user = user;
	}

	isSuperUser(){
		return this.user.role === 'admin'
	}

	isUser(){
		return this.user.role === 'user'
	}
}