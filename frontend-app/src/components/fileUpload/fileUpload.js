import axios from 'axios';
import React,{Component} from 'react';

require('dotenv').config()

class FileUpload extends Component {
	state = {
		selectedFile: null,
		errorMessage : '',
	};
	onFileChange = event => {
		this.setState({ selectedFile: event.target.files[0] });
	};
	
	onFileUpload = () => {
		let vm = this;
		const formData = new FormData();
		formData.append(
			"file", this.state.selectedFile,
		);
	
        axios.post(process.env.REACT_APP_API_BASE_URL+"expense/import",
        formData)
        .then(function(){
			vm.setState({ errorMessage: '' });
			window.location.reload(false);
        })
		.catch(function(errorResponse){
			if(errorResponse.response.status === 422){
				vm.setState({ errorMessage: errorResponse.response.data });
			}
		})
	};
	
	fileData = () => {
	
	if (!!this.state.errorMessage) {
		return (
			<div className='alert alert-danger' role="alert">
				{this.state.errorMessage}
			</div>
		);
	}
	};
	
	render() {
	
	return (
		<div className="col-md-5">
			<div className="row">
					<div className="input-group mb-3">
						<input type="file" onChange={this.onFileChange} className="form-control"/>
						<button onClick={this.onFileUpload} className="btn btn-primary position-relative">Upload!</button>
					</div>
					{this.fileData()}
			</div>
			
		</div>
	);
	}
}

export default FileUpload;
