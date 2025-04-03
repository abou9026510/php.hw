<?php
import { useState, useEffect } from "react";
import axios from "axios";

export default function CustomerCrudPage() {
  const [customers, setCustomers] = useState([]);
  const [newCustomer, setNewCustomer] = useState("");

  useEffect(() => {
    fetchCustomers();
  }, []);

  const fetchCustomers = async () => {
    const response = await axios.get("http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=webshop2&table=klant");
    setCustomers(response.data);
  };

  const addCustomer = async () => {
    if (newCustomer.trim()) {
      const response = await axios.post("http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=webshop2&table=klant", { name: newCustomer });
      setCustomers([...customers, response.data]);
      setNewCustomer("");
    }
  };

  const deleteCustomer = async (id) => {
    await axios.delete(`http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=webshop2&table=klant${id}`);
    setCustomers(customers.filter(customer => customer._id !== id));
  };

  return (
    <div className="p-4 max-w-md mx-auto bg-white shadow-md rounded-lg">
      <h1 className="text-xl font-bold mb-4">Klantbeheer</h1>
      <input 
        type="text" 
        value={newCustomer} 
        onChange={(e) => setNewCustomer(e.target.value)} 
        className="border p-2 w-full mb-2" 
        placeholder="Voeg een klant toe..."
      />
      <button onClick={addCustomer} className="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Toevoegen</button>
      <ul>
        {customers.map(customer => (
          <li key={customer._id} className="flex justify-between items-center border-b p-2">
            {customer.name}
            <button onClick={() => deleteCustomer(customer._id)} className="text-red-500">Verwijderen</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

?>
