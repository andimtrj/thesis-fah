## Product Controller Documentation

### Overview
The `ProductController` is responsible for managing product-related operations in the application. It handles the creation of new products, displaying product pages, and integrating product ingredients through a separate `ProductIngredientController`.

### Properties
- **$productIngredientController**: An instance of `ProductIngredientController` used for managing product ingredients.

### Constructor
- **__construct(ProductIngredientController $productIngredientController)**: Initializes the `$productIngredientController` property.

### Methods

#### InsertProduct(Request $request)
Handles the insertion of a new product into the database. It performs validation on the incoming request and uses a database transaction to ensure data integrity. The method also interacts with the `ProductIngredientController` to handle product ingredients.

#### GenerateProductCode()
Generates a unique product code by incrementing the last product code found in the database.

#### showProductPage(Request $request)
Displays the product page. It checks for specific request parameters to determine if a form was submitted and fetches necessary data based on the authenticated user's tenant ID.

#### showAddProductPage()
Displays the page for adding a new product. It fetches necessary data such as tenant, branches, ingredients, and product categories based on the authenticated user's tenant ID.

### Error Handling
The controller includes error handling that throws exceptions if the tenant ID is null, indicating missing or incorrect tenant information for the authenticated user.

### Usage
This controller is used in routes that require handling of product-related requests, ensuring that all operations are performed securely and reliably.
