import tkinter as tk
from tkinter import ttk, messagebox
import mysql.connector

# Function to calculate profit and insert data into the database
def add_product():
    product_number = int(entry_product_number.get())
    product_name = entry_product_name.get()
    selling_price = float(entry_selling_price.get())
    buying_price = float(entry_buying_price.get())
    profit = selling_price - buying_price

    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="products"
        )
        cursor = conn.cursor()
        cursor.execute("INSERT INTO myproduct (product_number, product_name, selling_price, buying_price, profit) VALUES (%s, %s, %s, %s, %s)",
                       (product_number, product_name, selling_price, buying_price, profit))
        conn.commit()
        messagebox.showinfo("Success", "Product added successfully!")
    except mysql.connector.Error as err:
        messagebox.showerror("Error", f"Error: {err}")
    finally:
        cursor.close()
        conn.close()

# Function to fetch data from the database and display it in the table
def fetch_data():
    for row in tree.get_children():
        tree.delete(row)
    
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="products"
        )
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM myproduct")
        rows = cursor.fetchall()
        
        for row in rows:
            tree.insert("", tk.END, values=row)
        
    except mysql.connector.Error as err:
        messagebox.showerror("Error", f"Error: {err}")
    finally:
        cursor.close()
        conn.close()

# Create the main window
root = tk.Tk()
root.title("Product Entry and Display")

# Create and place the labels and entry fields
tk.Label(root, text="Product Number").grid(row=0, column=0)
entry_product_number = tk.Entry(root)
entry_product_number.grid(row=0, column=1)

tk.Label(root, text="Product Name").grid(row=1, column=0)
entry_product_name = tk.Entry(root)
entry_product_name.grid(row=1, column=1)

tk.Label(root, text="Selling Price").grid(row=2, column=0)
entry_selling_price = tk.Entry(root)
entry_selling_price.grid(row=2, column=1)

tk.Label(root, text="Buying Price").grid(row=3, column=0)
entry_buying_price = tk.Entry(root)
entry_buying_price.grid(row=3, column=1)

# Create and place the buttons
tk.Button(root, text="Add Product", command=add_product).grid(row=4, column=0, columnspan=2)
tk.Button(root, text="Display Products", command=fetch_data).grid(row=5, column=0, columnspan=2)

# Create a Treeview widget for displaying the products
tree = ttk.Treeview(root, columns=("Product Number", "Product Name", "Selling Price", "Buying Price", "Profit"), show='headings')
tree.heading("Product Number", text="Product Number")
tree.heading("Product Name", text="Product Name")
tree.heading("Selling Price", text="Selling Price")
tree.heading("Buying Price", text="Buying Price")
tree.heading("Profit", text="Profit")

tree.grid(row=6, column=0, columnspan=2, sticky='nsew')

# Run the application
root.mainloop()
