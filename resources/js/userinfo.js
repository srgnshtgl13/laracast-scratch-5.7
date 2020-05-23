export default class UserInfo{
	constructor(user=""){
		this.user = user
	}

	name(){
		return this.user.name
	}
	email(){
		return this.user.email
	}
}