export default class Errors {
	constructor() {
		this.errors = {};
	}

	/**
	 * Get the error to specific field 
	 */
	get(field) {
		if (this.errors[field]) {
			return this.errors[field][0];
		}

	}

	/**
	 * Add error or errors to errors object if request failed 
	 */
	record(errors) {
		this.errors = errors;
	}

	/**
	 * Clear the errors object
	 */
	clear(field) {
		if (field) {
			delete this.errors[field]
			return
		}
		this.errors = {}
	}

	/**
	 * if there is an error to specific field
	 */
	has(field) {
		return this.errors.hasOwnProperty(field);

		/***	has Own property feature
			var x = {
			    y: 10
			};
			console.log(x.hasOwnProperty("y")); //true
			console.log(x.hasOwnProperty("z")); //false
		*/
	}

	/**
	 * it will be used to disable the submit form button
	 */
	any() {
		return Object.keys(this.errors).length > 0;
		// Object.keys('array') => // Returns an array of enumerable properties 
	}
}