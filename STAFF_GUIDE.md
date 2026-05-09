# Staff User Guide

**Inventory Management System - For Staff Users**

---

## Table of Contents
1. [Getting Started](#getting-started)
2. [Dashboard Overview](#dashboard-overview)
3. [Viewing Products](#viewing-products)
4. [Viewing Inventory](#viewing-inventory)
5. [Understanding Your Role](#understanding-your-role)
6. [Common Staff Tasks](#common-staff-tasks)
7. [Tips & Best Practices](#tips--best-practices)

---

## Getting Started

### Login to Your Account

1. Open your browser and go to: **http://127.0.0.1:8000**
2. Click **Login** in the navigation bar
3. Enter your staff credentials:
   - **Email**: `staff@inventory.com`
   - **Password**: `Staff@1234`
4. Click **Login**
5. You'll be directed to the **Dashboard**

### Your Staff Account Details
- **Role**: Staff (Read-Only Access)
- **Email**: staff@inventory.com
- **Access**: Products and Inventory viewing only
- **Restrictions**: Cannot create, edit, or delete anything

---

## Dashboard Overview

### What You'll See

When you first login, the dashboard shows you:

**1. Total Products Card (Rosy Brown)**
- Shows how many products are in the inventory system
- This is a **view-only metric**
- Example: "24 Total Products"

**2. Low Stock Items Card (Rosy Brown)**
- Shows products that need attention
- When quantity ≤ reorder level, it counts as "low stock"
- Alerts help identify items that may need reordering
- **Your manager handles reordering**

**3. Recent Transactions Card (Moss Green)**
- Shows how many transactions have occurred recently
- Transactions = any movement in/out of inventory
- Example: "18 Recent Transactions"

### Quick Actions Section

As a staff member, you have **limited quick actions**:
- **View Products**: Open the product list to check what's available
- **All other buttons are admin-only**: Only managers can add/edit categories, suppliers, and view reports

### Recent Transactions Table

Shows the latest inventory activity:
- **Date**: When the transaction occurred
- **Product**: What product was moved
- **Type**: IN (received) or OUT (sold/used)
- **Quantity**: How many units were moved
- **By**: Which user performed the action

**Your Role**: Monitor and understand what's happening, but you don't record transactions directly.

---

## Viewing Products

### Access the Product List

1. Click **Products** in the navigation menu
2. Or click **View Products** from the dashboard
3. You'll see a table of all products

### What You Can See

For each product, you can view:
- **Product Name**: Full name of the item
- **SKU**: Stock Keeping Unit (unique code)
- **Category**: What type of product it is (Electronics, Office Supplies, etc.)
- **Price**: Cost per unit
- **Action**: Click to view more details

### View Product Details

1. Find a product in the list
2. Click the **View** button (eye icon)
3. You'll see:
   - Full product description
   - Category and supplier information
   - Price
   - Images (if uploaded)
   - When it was added to the system

### Understanding SKU Codes

SKU = Stock Keeping Unit (unique identifier)
- **LAPTOP-001** = First laptop model
- **CHAIR-ERGO-BLK** = Ergonomic black chair
- Ask your manager if the codes don't make sense

### Product Categories

The system groups products by categories:
- **Electronics**: Computers, monitors, cables, etc.
- **Office Supplies**: Paper, pens, folders, etc.
- **Furniture**: Desks, chairs, shelves, etc.

---

## Viewing Inventory

### Access Inventory Levels

1. Click **Inventory** in the navigation menu
2. See a list of all inventory records

### What Inventory Means

**Inventory** = The current stock level of each product

For each item, you can see:
- **Product Name**: Which product it is
- **Current Quantity**: How many units are in stock right now
- **Reorder Level**: The minimum quantity threshold
- **Location**: Where the product is stored (Warehouse A, Warehouse B, etc.)

### Understanding Stock Levels

**Example:**
```
Product: Laptop Dell XPS
Quantity: 15 units
Reorder Level: 5 units
Location: Warehouse A

Status: ✅ Good (Quantity > Reorder Level)
```

**Another Example:**
```
Product: Wireless Mouse
Quantity: 2 units
Reorder Level: 10 units
Location: Warehouse B

Status: ⚠️ Low Stock (Quantity < Reorder Level)
```

### Low Stock Warning

When a product's quantity drops below or equals its reorder level:
- It shows as "Low Stock"
- Your admin/manager can see this on the dashboard
- **Your role**: Report low stock items to management

---

## Understanding Your Role

### ✅ What You CAN Do

1. **View Products**
   - See all products in the system
   - Check product details
   - View prices and categories

2. **Check Inventory**
   - See current stock levels
   - Identify low stock items
   - View storage locations

3. **Monitor Transactions**
   - View recent activity
   - See what's been moving in/out
   - Track movement history

4. **Manage Your Profile**
   - Update your personal information
   - Change your password
   - Update your email address

### ❌ What You CANNOT Do

1. **Create New Items**
   - Cannot add new products
   - Cannot create categories
   - Cannot add suppliers

2. **Modify Inventory**
   - Cannot update quantities
   - Cannot change reorder levels
   - Cannot edit locations

3. **Delete Items**
   - Cannot delete products
   - Cannot remove categories
   - Cannot remove suppliers

4. **Generate Reports**
   - Cannot view reports (admin only)
   - Cannot see financial data
   - Cannot generate analytics

> **Important**: These restrictions exist to maintain data integrity. If you need to change something, ask your admin/manager.

---

## Common Staff Tasks

### Task 1: Check if a Product is in Stock

**Scenario**: A customer asks if you have "Wireless Mouse"

1. Go to **Products**
2. Click **View Products** if not already there
3. Find "Wireless Mouse" in the list
4. Click **View** to see details
5. Check the inventory:
   - Current Quantity: 15 units
   - Status: In Stock ✅

**Or use Inventory:**
1. Go to **Inventory**
2. Find "Wireless Mouse"
3. See Quantity: 15
4. Report to customer: "Yes, we have 15 Wireless Mouses in stock"

### Task 2: Identify What's Low in Stock

**Scenario**: Management asks what items need reordering

1. Go to **Inventory**
2. Look for items where Quantity ≤ Reorder Level
3. Make a list:
   - Portable SSD: 3 units (reorder level: 5) ⚠️
   - Stapler: 2 units (reorder level: 8) ⚠️
   - Monitor 4K: 8 units (reorder level: 5) ✅

4. Report to admin: "These 2 items are low on stock"

### Task 3: Review Recent Activity

**Scenario**: Track what happened to inventory today

1. Go to **Dashboard**
2. Scroll to "Recent Transactions" table
3. Review activity:
   - Date: 04/01/2026
   - Product: Laptop Dell XPS
   - Type: OUT (sold/received out)
   - Qty: 1
   - By: Admin User
4. Understand the movement and report if needed

### Task 4: Check Product Pricing

**Scenario**: Customer asks the price of an item

1. Go to **Products**
2. Find the product in the list
3. See the **Price** column
4. Example: "Laptop Dell XPS: $1,299.99"

### Task 5: Find Product Location in Warehouse

**Scenario**: You need to locate a product physically

1. Go to **Inventory**
2. Find the product
3. See the **Location** field
4. Example: "Laptop Dell XPS is in Warehouse A"
5. Go retrieve it

---

## Tips & Best Practices

### ✅ Best Practices

1. **Regular Checking**
   - Check the dashboard at the start of your shift
   - Review low stock items daily
   - Monitor recent transactions

2. **Communication**
   - Inform your manager about low stock items
   - Report any inventory discrepancies
   - Ask questions if you don't understand data

3. **Customer Service**
   - Use the product list to answer customer questions
   - Check inventory before promising stock
   - Reference product SKUs for accuracy

4. **Data Accuracy**
   - Don't try to modify or delete anything
   - Report errors to your administrator
   - Flag suspicious transactions

5. **Privacy**
   - Keep your login credentials private
   - Don't share your password with anyone
   - Log out when you're done working

### ❌ Things to Avoid

1. **Don't Try To:**
   - Edit product information (you can't anyway)
   - Delete or remove items
   - Modify inventory quantities
   - Access admin features (you don't have permission)

2. **Be Careful:**
   - Don't give out sensitive pricing to customers
   - Don't promise stock without checking system first
   - Don't make up information about products
   - Don't assume the system is always 100% accurate

3. **Report Issues:**
   - If data seems wrong, report to admin
   - If you can't access something, ask for help
   - If prices seem incorrect, verify with manager

### 🎯 Example Daily Workflow

```
9:00 AM - Start of Day
↓
1. Login to system (staff@inventory.com)
2. Go to Dashboard
3. Check total products available
4. Check low stock alerts
5. Review recent activity
↓
Throughout Day
↓
- Answer customer questions using Products section
- Check inventory levels for stock availability
- Report any discrepancies to admin
↓
5:00 PM - End of Day
↓
- Review any new transactions
- Note items that were moved/sold
- Log out properly
- Report daily observations to manager
```

---

## System Navigation

### Main Menu (Header)

**Available Links for You:**
```
📦 Inventory System (Logo)
├── Dashboard (View metrics and activity)
├── Products (View all products)
├── Inventory (View stock levels)
└── Your Name (Profile dropdown)
    ├── Profile (Edit your info)
    └── Logout (Exit system)
```

**Admin-Only Links (You'll see them but can't click):**
- Categories
- Suppliers
- Reports

### Common Paths

**To check product availability:**
Products → Find Product → View Details → Check Quantity

**To report low stock:**
Inventory → Find Low Stock Items → Report to Admin

**To check recent activity:**
Dashboard → Scroll to Recent Transactions → Review

---

## FAQs

### Q: Can I view product prices?
**A**: Yes! Go to Products and see the price column.

### Q: Can I create a new product?
**A**: No. Only admins can create products. Contact your manager if you need a new product added.

### Q: What does "Reorder Level" mean?
**A**: It's the minimum amount before the item is considered "Low Stock". When quantity drops to this level or below, it signals time to reorder.

### Q: Can I change my password?
**A**: Yes! Go to Profile → Change Password. Your current password is `Staff@1234`

### Q: Can I delete a product?
**A**: No. Even admins rarely delete products. Contact your manager if a product needs to be removed.

### Q: What if I find an error in the data?
**A**: Take a screenshot or note it down, then report it to your admin/manager. They can investigate and fix it.

### Q: How do I know if something is in low stock?
**A**: Check Inventory → If Quantity ≤ Reorder Level, it's low stock. Or check the Dashboard red card.

### Q: Can I logout?
**A**: Yes! Click your name in the top-right → Click "Logout"

### Q: How do I log back in?
**A**: Use the same credentials: staff@inventory.com / Staff@1234

---

## Remember

✅ **You Are Helping!**
- By monitoring inventory, you help the business run smoothly
- Your reports about low stock help with purchasing decisions
- Your attention to detail prevents stockouts

⚠️ **Report Problems**
- If something doesn't look right, report it
- Don't assume or make changes yourself
- Your admin/manager is there to help

✔️ **Keep Learning**
- Familiarize yourself with product categories
- Learn common product codes
- Understand what "in stock" vs "low stock" means

---

## Need Help?

### Quick Reference

| Need | Go To |
|------|-------|
| See all products | **Products** menu |
| Check stock level | **Inventory** menu |
| View recent activity | **Dashboard** |
| Update your info | Click **Your Name** → **Profile** |
| Change password | **Profile** → **Password** |
| Ask a question | Contact your **Admin/Manager** |

### Contact Your Administrator

If you:
- Need admin access
- Found an error
- Have technical issues
- Want to request features

→ Contact your administrator or manager

---

## System Information

**System**: Inventory Management System v1.0
**Status**: ✅ Active and Running
**Your Role**: Staff (Read-Only)
**Access**: Dashboard, Products, Inventory, Profile

**Important**: This system is for authorized personnel only. Do not share credentials with unauthorized users.

---

**Last Updated**: April 1, 2026
**Version**: 1.0 - Staff Edition
