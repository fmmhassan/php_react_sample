import { useState, useEffect } from "react";
import axios from 'axios';
require('dotenv').config()


export default function ExpensesSummaryTable() {
 const [expensesSummary, setData] = useState(null);
 const [loading, setLoading] = useState(true);

 useEffect(() => {
    

    setLoading(true);
    axios.get(process.env.REACT_APP_API_BASE_URL+'expense/summary')
    .then(responseData => {
        setData(responseData.data);
    })
    .finally(() => {
        setLoading(false);
    })
   }, []);
   

   return (
    <div className="table-responsive">
        {loading && <div>Loading...</div>}
        {
            expensesSummary!==null &&
            
            <table className="table table-striped">
                <tbody>

                    {!loading && expensesSummary &&
                    expensesSummary.map(({  Category, Amount }) => (
                    <tr key={Category}>
                        <th className="align-left table-cell">{Category}</th>
                        <td className="table-cell">{Amount}</td>
                    </tr>
                    ))}
                </tbody>

            </table>
        }
        
        
    </div>
  );
}
