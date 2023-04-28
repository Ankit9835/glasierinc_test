import axios from 'axios'
import React, { useEffect, useState } from 'react'


function App() {
  const [product,setProduct] = useState([])
  const newProduct = async () => {
    try {
     const response = await axios.get('http://127.0.0.1:8000/api/products',{
      headers:{
        Authorization:'Bearer 1|UeS2WKABAs4aU3HtkizWyI1zRE6h5M4ZQISJ7yG9'
      }
  })
     console.log('test response',response)
      setProduct(response.data.data)
    //  setProduct(response.data.product)
    //  setLoading(false)
    } catch (error) {
     console.log(error.response)
    
    }
 }
 useEffect(() => {
  newProduct()
 },[])
  return (
    <>
    <div className="container">
      <div className="row">
      {product.map((p) => (
          <div className="col" key={p._id}>
            <div class="card" style={{ width: "18rem" }}>
            
            <div class="card-body">
              <h5 class="card-title">{p.product_name}</h5>
              <p class="card-text">Price - {p.discount_price}</p>
              <p class="card-text">Quantity - {p.product_quantity}</p>

            </div>
          </div>
          </div>
        ))}
      </div>
        
      </div>
      
    </>
  );
}

export default App;
