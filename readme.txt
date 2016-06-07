Welcome to the "kitchen!"

This is a custom shopping cart that's being put together for "RTA Kitchen Cabinets." You can see their current website at http://www.rtakitchencabinetsonline.com/.

You'll find the database file along with everything else that you'll need to set up your local environment. 

In order to complete this project, here's what needs to happen:

1) If the customer that's getting ready to check out is a returning customer, they need to be able to login and all of their information be automatically populated at the bottom of  checkout_login.php

2) Once the customer has either logged in or manually filled in the shipping and billing information fields, they need to be routed to a page where they can then either 
enter the credit card infomation (you will need to build the credit card interface using the client's current cc validation service)
choose by Paypal  (you will need to build the credit card interface using the client's current Paypal information)
choose an option that allows them to pay by check

These options need to be presented to the customer along with the option of returning to their Shopping Cart. 

3) Once the customer has hit "proceed to checkout" after either logging in or filling in the shipping and billing information fields, their order needs to be deleted from the "cart" and put into an "orders" table. There their order will remain in a "pending" status. That "pending" status will be automatically updated to a "paid" status once their credit card info / Paypal info has been validated. If they're paying by check, the status will be manually updated from the Admin suite.

4) The last stage of the checkout process has the customer choosing the manner in which they pay. If it's by credit card or paypal, that interface will be engaged and the user will be routed to a page that lets them know that their payment has been accepted. They'll also receive an email that confirms that and includes their invoice number.

5) The admin page includes an interface that allows the administrator to view a list of all orders - both those that are pending and those that have been paid for. That same page allows the user to "check" off those that have been shipped.

6) The entire site needs to be converted to a Bootstrap site.

The entire budget for this project is $500.00. Regardless of your hourly rate / how much time it takes you to complete the above tasks, that $500.00 is yours. If it takes more time than what you originally estimated, your compenstation is $500.00. Then again, if it takes less time, you still get paid the entire 500 dollar amount.