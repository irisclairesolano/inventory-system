# Administrator User Guide

**Inventory Management System - For Admin Users**

---

## Table of Contents
1. [Getting Started](#getting-started)
2. [Dashboard Overview](#dashboard-overview)
3. [Managing Products](#managing-products)
4. [Managing Categories](#managing-categories)
5. [Managing Suppliers](#managing-suppliers)
6. [Managing Inventory](#managing-inventory)
7. [Viewing Reports](#viewing-reports)
8. [Common Admin Tasks](#common-admin-tasks)
9. [Tips & Best Practices](#tips--best-practices)

---

## Getting Started

### Login to Your Account
1. Open your browser and go to: **http://127.0.0.1:8000**
2. Click **Login** in the navigation bar
3. Enter your admin credentials:
   - **Email**: `admin@inventory.com`
   - **Password**: `Admin@1234`
4. Click **Login**

### First Login - What to Expect
- You'll be directed to the **Dashboard**
- The system shows 3 summary cards with key metrics
- Quick action buttons are available for common tasks
- Recent transactions are displayed at the bottom

---

## Dashboard Overview

### Dashboard Metrics

**1. Total Products**
- Shows the complete count of all products in the system
- Includes all categories and suppliers
- **Rosy Brown card** on the left

**2. Low Stock Items**
- Displays products where quantity ≤ reorder level
- **Rosy Brown card** in the center (alerts you to stock issues)
- Click to view inventory details

**3. Recent Transactions**
- Shows recent inventory movements
- **Moss Green card** on the right
- Click to view full transaction history

### Quick Actions
- **View Products**: See all products in the system
- **Add Product**: Create a new product (admin only)
- **Manage Categories**: Create/edit/delete categories
- **View Reports**: Access detailed analytics and reports

### Recent Transactions Table
- Shows the latest inventory movements
- Includes: Date, Product Name, Transaction Type (IN/OUT), Quantity, User
- Helps track who did what and when

---

## Managing Products

### View All Products

1. Click **Products** in the navigation menu (or click "View Products" on dashboard)
2. You'll see a table with:
   - Product Name
   - SKU (Stock Keeping Unit)
   - Category
   - Price
   - Actions (View, Edit, Delete)

**Product List Features:**
- **Search**: Use Ctrl+F to search on current page
- **Pagination**: Navigate through pages if many products exist
- **Edit**: Click Edit button to modify product details
- **Delete**: Click Delete to remove a product (cannot be undone)

### Create a New Product

1. Click **Products** → **Add Product** button
2. Fill in the required fields:
   - **Product Name** *(required)*: e.g., "Laptop Computer"
   - **Category** *(required)*: Select from dropdown
   - **Supplier** *(required)*: Select from dropdown
   - **Price** *(required)*: e.g., 999.99
   - **SKU** *(optional)*: Unique identifier, e.g., "LAPTOP-001"
   - **Description** *(optional)*: Details about the product
   - **Image** *(optional)*: Upload a product photo (JPG/PNG, max 2MB)

3. Click **Save Product**
4. **Inventory Record**: A corresponding inventory record is automatically created

### Edit a Product

1. Go to **Products**
2. Find the product and click the **Edit** button
3. Update any information you need to change
4. Click **Save Product**
5. The system will update and redirect you back to the list

### Delete a Product

1. Go to **Products**
2. Find the product and click the **Delete** button
3. Confirm the deletion
4. **Note**: Deleting a product also removes its inventory records

---

## Managing Categories

### View All Categories

1. Click **Categories** in the navigation menu
2. See a list of all product categories with:
   - Category Name
   - Description
   - Number of Products
   - Actions (View, Edit, Delete)

### Create a Category

1. Click **Categories** → **Add Category** button
2. Enter:
   - **Category Name** *(required, unique)*: e.g., "Electronics"
   - **Description** *(optional)*: e.g., "Electronic devices and accessories"
3. Click **Save Category**

### Edit a Category

1. Go to **Categories**
2. Click the **Edit** button for the category
3. Update the name or description
4. Click **Save Category**

### Delete a Category

1. Go to **Categories**
2. Click the **Delete** button
3. **Note**: You can only delete categories with NO products
4. If products exist, you'll see an error message

**Important**: Before deleting a category, move or delete all its products first.

---

## Managing Suppliers

### View All Suppliers

1. Click **Suppliers** in the navigation menu
2. See all suppliers with:
   - Supplier Name
   - Email
   - Phone
   - Number of Products
   - Actions

### Create a Supplier

1. Click **Suppliers** → **Add Supplier** button
2. Enter:
   - **Name** *(required)*: e.g., "Tech Distributors Inc."
   - **Email** *(optional)*: e.g., "sales@tech.com"
   - **Phone** *(optional)*: e.g., "555-0001"
   - **Address** *(optional)*: Full supplier address
3. Click **Save Supplier**

### Edit a Supplier

1. Go to **Suppliers**
2. Click **Edit** for the supplier
3. Update contact information
4. Click **Save Supplier**

### Delete a Supplier

1. Go to **Suppliers**
2. Click **Delete**
3. **Note**: Only suppliers with NO products can be deleted
4. Similar to categories, reassign products first if needed

---

## Managing Inventory

### View Inventory Levels

1. Click **Inventory** in the navigation menu
2. See all inventory records with:
   - Product Name
   - Current Quantity
   - Reorder Level
   - Location
   - Action buttons

### Add Inventory for a Product

1. Click **Inventory** → **Add Stock** button
2. Select:
   - **Product** *(required)*: Choose from dropdown
   - **Quantity** *(required)*: How many units in stock
   - **Reorder Level** *(required)*: At what quantity should alert trigger
   - **Location** *(optional)*: Where is it stored (e.g., "Warehouse A")
3. Click **Save Inventory**

### Update Inventory Levels

1. Go to **Inventory**
2. Find the product and click **Edit**
3. Update:
   - **Quantity**: Current stock count
   - **Reorder Level**: Alert threshold
   - **Location**: Storage location

4. Click **Save Inventory**

### Low Stock Warning

- When quantity ≤ reorder level, the product is flagged as "Low Stock"
- It appears in the dashboard red card
- Check the dashboard regularly to monitor stock levels
- An email alert can be sent to inventory managers

---

## Viewing Reports

### Access Reports

1. Click **Reports** in the navigation menu
2. You'll see:
   - **Total Products**: Complete inventory count
   - **Total Inventory Value**: Sum of (price × quantity) for all products
   - **Low Stock Items**: Products below reorder level
   - **Stock by Category**: Breakdown of inventory per category
   - **Recent Transactions**: Detailed transaction history (last 20)

### Analyze Reports

**Use Reports to:**
- Monitor total inventory value
- Identify low stock situations
- See which categories are well-stocked
- Track transaction history
- Make purchasing decisions
- Plan inventory restocking

### Report Data Points
- **Total Value** = Sum of all (product price × quantity)
- **Categories** = Split of inventory across product categories
- **Transactions** = Complete movement history with dates and users

---

## Common Admin Tasks

### Restock a Product

1. Go to **Inventory**
2. Find the low-stock product
3. Click **Edit**
4. Increase the **Quantity** value
5. Optionally update **Reorder Level**
6. Click **Save Inventory**

**Alternative**: Use **Dashboard** → View the red "Low Stock" card to quickly identify items needing attention.

### Create a New Product Category

1. **Categories** → **Add Category**
2. Enter name and description
3. Save
4. Now this category is available when creating products

### Set Up a New Supplier

1. **Suppliers** → **Add Supplier**
2. Enter contact information
3. Save
4. You can now link products to this supplier

### Analyze Inventory Value

1. Go to **Reports**
2. View the **Total Inventory Value** at the top
3. Use this to:
   - Understand total assets invested in inventory
   - Make budget decisions
   - Identify high-value inventory areas

### Track Product Movement

1. **Dashboard** → See "Recent Transactions" table
2. Or go to **Reports** → Full transaction history
3. Monitor what products move in/out
4. Verify who made each movement

---

## Tips & Best Practices

### ✅ Do's

1. **Regular Monitoring**
   - Check the dashboard daily
   - Review low stock alerts regularly
   - Monitor reorder levels

2. **Preventive Maintenance**
   - Set reorder levels strategically (not too high, not too low)
   - Regularly update product information
   - Keep supplier contact info current

3. **Organization**
   - Use meaningful SKU codes (e.g., "ELEC-001", "FURN-002")
   - Store products in consistent locations
   - Document product images for quick identification

4. **Data Integrity**
   - Don't delete products unnecessarily
   - Update quantities accurately
   - Include clear product descriptions

5. **Security**
   - Change your password regularly
   - Never share your admin credentials
   - Log out after each session

### ❌ Don'ts

1. **Avoid**
   - Deleting categories with products (remove products first)
   - Setting reorder level too high (wastes storage)
   - Using generic product names
   - Leaving supplier information incomplete

2. **Be Careful With**
   - Deleting products (cannot be undone)
   - Changing prices of existing products
   - Moving large quantities at once (verify first)

3. **Don't Forget**
   - To update inventory when products arrive
   - To set appropriate reorder levels
   - To check reports regularly for insights

### 🎯 Workflow Example: Adding a New Product

```
1. Supplier calls: "I have 50 new laptops available"
   ↓
2. Create Supplier (if new) → Suppliers menu
   ↓
3. Create Product → Products → Add Product
   - Name: "Laptop Dell XPS"
   - Category: Electronics
   - Supplier: The one you just created
   - Price: Per unit cost
   - SKU: DELL-XPS-001
   ↓
4. Set Inventory → Inventory → Add Stock
   - Quantity: 50
   - Reorder Level: 10
   - Location: Warehouse A
   ↓
5. Monitor Dashboard → Check stock is showing
   ↓
6. Track Sales/Usage → Inventory decreases as units sell
   ↓
7. When quantity drops to ~10 → Dashboard alerts (Low Stock)
   ↓
8. Place new order with supplier
```

### 📊 Monthly Admin Checklist

- [ ] Review all low stock items
- [ ] Update supplier information if changed
- [ ] Check total inventory value in Reports
- [ ] Reconcile physical count vs system count
- [ ] Review transaction history for anomalies
- [ ] Update product prices if needed
- [ ] Archive old completed transactions
- [ ] Change admin password

---

## Need Help?

### Common Issues

**Q: Can I delete a product?**
A: Yes, but it's permanent. The system will also delete its inventory records. Consider marking as discontinued instead of deleting.

**Q: What if I set reorder level wrong?**
A: Go to Inventory → Edit the product → Change reorder level → Save

**Q: How do I know what items are low stock?**
A: Dashboard shows red "Low Stock Items" card. Also check Inventory or Reports for details.

**Q: Can I undo a deletion?**
A: No. Deletes are permanent. Be careful with the Delete button.

**Q: How do I see who made a transaction?**
A: Dashboard or Reports shows the user who made each transaction.

---

## Support

- Review SYSTEM_DOCUMENTATION.md for technical details
- Check database for audit trails
- Contact system administrator for technical issues
- Refer to Laravel documentation for framework-specific questions

**System Status**: ✅ Active and Ready

**Last Updated**: April 1, 2026
