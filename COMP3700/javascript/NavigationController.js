 $(document).on("click", ".show-books-nav", function() {
	 $(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Books/ShowBooks.html", function() {showBooks();});});
 });
 $(document).on("click", ".create-book-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Books/CreateBook.html", function() {$(".body").slideDown();});});
 });
 
 $(document).on("click", ".show-authors-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Authors/ShowAuthors.html", function() {showAuthors();});});
 });
 $(document).on("click", ".create-author-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Authors/CreateAuthor.html", function() {$(".body").slideDown();});});
 });
 
 $(document).on("click", ".show-accounts-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Accounts/ShowAccounts.html", function() {showAccounts();});});
 });
 $(document).on("click", ".create-account-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Accounts/CreateAccount.html", function() {$(".body").slideDown();});});
 });
 
 $(document).on("click", ".show-reports-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Reports/ShowReports.html", function() {showReports();});});
 });
 
  $(document).on("click", ".show-waitreports-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/WaitReports/ShowWaitReports.html", function() {showWaitReports();});});
 });
 
 $(document).on("click", ".show-book-reviews-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Reviews/ShowBookReviews.html", function() {showBookReviews();});});
 });
 
 $(document).on("click", ".show-author-reviews-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Reviews/ShowAuthorReviews.html", function() {showAuthorReviews();});});
 });
 
 $(document).on("click", ".show-accountdetails-nav", function() {
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Accounts/AccountDetails.html", function() {showMyAccountDetails();});});
 });