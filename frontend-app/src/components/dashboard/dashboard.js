import './dashboard.css';
import React, { Component } from 'react';
import axios from 'axios';
import FileUpload from '../fileUpload/fileUpload';
import ExpensesSummaryTable from '../expensesSummaryTable/expensesSummaryTable';
require('dotenv').config()

class Dashboard extends Component {
    downloadAsCSV(){
        axios.post(process.env.REACT_APP_API_BASE_URL+"expense/export")
        .then(function(response){
			const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", "template.csv");
            document.body.appendChild(link);
            link.click();
        })
    }
    render(){
        return (
            <div className="container-fluid">
                <div className='container'>
                    <div className='row'>
                        <h1>PHP React CSV Reader</h1>
                        
                    </div>
                    <div className="row">
                        <h3>Upload expenses</h3>
                        <FileUpload></FileUpload>
                    </div>
                    <div className="row">
                        <div className="col-3">
                            <h3>Expenses Summary Info</h3>
                        </div>
                    </div>
                    <div className='row'>
                        <div className="col-2">
                            <button type="button" onClick={this.downloadAsCSV} className="btn btn-primary position-relative">
                            Download as CSV <span className="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2"><span className="visually-hidden">unread messages</span></span>
                            </button>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <ExpensesSummaryTable></ExpensesSummaryTable>
                        </div>
                    </div>
                </div>

            </div>
            );
        }
    }
    
 
 
export default Dashboard;