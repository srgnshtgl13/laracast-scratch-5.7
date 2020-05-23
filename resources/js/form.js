import Errors from './errors.js';


export default class Form{
	constructor(data){
		
		this.originalData = data // make copy the data which is come from form to originalData variable

		//create the fields => title: title ...
		for(let field in data){
			this[field] = data[field]
		}

		this.errors = new Errors()
	}

	/**
	 * Clear the form fields after successful request
	 * or if there is a modal after closed the modal can be cleared the fields as well 
	 */
	reset(){
		// cleat the fields 
		for(let field in this.originalData){
			this[field] = ''
		}
		this.errors.clear()
	}

	/**
	  * Just a testing to understand the Promise features
	  * Using promise is better than using callback 
	  */
	/*
	promiseExample(){
		const givePromise = new Promise(function(resolve, reject){
			var promise = true
		if (promise) {
		    resolve('Thats OK!');
		} else {
		    reject('Something goes wrong...');
		  }
		})

		givePromise.then((answer)=>{
		  console.log(answer) // 'Thats OK!'
		}).catch((fail)=>{
		  console.log(fail) // 'Something goes wrong...'
		})
	}*/

	/**
	 * Get the form fields..
	 */
	data(){

		/*
		let data = Object.assign({},this) // it will clone the object like that { originalData: {…}, title: "", description: "", errors: {…} } to data variable
		// now we need from this clone data only the title and description. we can do like below
		delete data.originalData	// we don't care about the originalData
		delete data.errors 	// we dont care about the errors
		*/
		
		// instead of doing like above we can do like below

		/**
		  * we have the originalData inside the constructor which is we made copy from data come from Vue component form
		  * so we can loop through this originalData and we can assign each one of its attributes to the empty data
		 */
		let data = {}
		for (let property in this.originalData) {
			data[property] = this[property]	// it simply says data.title = this.title and data.description = this.description
		}

		return data
	}

	/**
	 * Make a post request..
	 */
	post(url){
		return this.submit('post',url);
	}

	/**
	 * Make a delete request..
	 */
	delete(url){
		return this.submit('delete',url);
	}

	/**
	 * Make a patch request..
	 */
	patch(url){
		return this.submit('patch',url);
	}

	/**
	 * It will be used to make any request..
	 */
	submit(requestType, url){
		return new Promise((resolve,reject)=>{	// if everythings go according to the plan we will call the resolve otherwise call the reject

			axios[requestType](url,this.data())
			                    .then(response=>{
			                    	this.onSuccess(response.data)
			                    	resolve(response.data); // this says "I got the data. What do you wanna with it?"
			                    })
			                    .catch(err=>{
			                    	this.onFail(err.response.data.errors)
			                    	reject(err.response.data.errors)
			                    })
		})
	}

	/**
	 * If request is made in successfully..
	 */
	onSuccess(data){
		//alert(data.message)
	   
	   this.reset()
	}

	/**
	 * If request is failed..
	 */
	onFail(errors){
		this.errors.record(errors)
		
	}
}