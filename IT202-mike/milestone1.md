<table><tr><td> <em>Assignment: </em> IT202 Milestone1 Deliverable</td></tr>
<tr><td> <em>Student: </em> Michael Bernstein (mb2297)</td></tr>
<tr><td> <em>Generated: </em> 12/1/2023 9:58:06 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-101-F23/it202-milestone1-deliverable/grade/mb2297" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone1 branch</li><li>Create a milestone1.md file in your Project folder</li><li>Git add/commit/push this empty file to Milestone1 (you'll need the link later)</li><li>Fill in the deliverable items<ol><li>For each feature, add a direct link (or links) to the expected file the implements the feature from Heroku Prod (I.e,&nbsp;<a href="https://mt85-prod.herokuapp.com/Project/register.php">https://mt85-prod.herokuapp.com/Project/register.php</a>)</li></ol></li><li>Ensure your images display correctly in the sample markdown at the bottom</li><ol><li>NOTE: You may want to try to capture as much checklist evidence in your screenshots as possible, you do not need individual screenshots and are recommended to combine things when possible. Also, some screenshots may be reused if applicable.</li></ol><li>Save the submission items</li><li>Copy/paste the markdown from the "Copy markdown to clipboard link" or via the download button</li><li>Paste the code into the milestone1.md file or overwrite the file</li><li>Git add/commit/push the md file to Milestone1</li><li>Double check the images load when viewing the markdown file (points will be lost for invalid/non-loading images)</li><li>Make a pull request from Milestone1 to dev and merge it (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku dev</li></ol></li><li>Make a pull request from dev to prod (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku prod</li></ol></li><li>Submit the direct link from github prod branch to the milestone1.md file (no other links will be accepted and will result in 0)</li></ol></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Feature: User will be able to register a new account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.29.23invalidemail.png.webp?alt=media&token=cf7e9870-9c9e-4951-a5e4-e892ad0ef658"/></td></tr>
<tr><td> <em>Caption:</em> <p>invalid email<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T02.13.37invalidusername.png.webp?alt=media&token=6c97c156-a718-449e-8165-17abda1008f8"/></td></tr>
<tr><td> <em>Caption:</em> <p>invalid password<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.29.18passwordmissmatch.png.webp?alt=media&token=c4811496-fe12-4153-8669-9683e00dbf61"/></td></tr>
<tr><td> <em>Caption:</em> <p>password mismatch<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.32.37invalidemail.png.webp?alt=media&token=77bb019e-ac96-4910-be9b-2ee55aeee82f"/></td></tr>
<tr><td> <em>Caption:</em> <p>email not available<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.32.40invaliduser.png.webp?alt=media&token=4d51c865-5d75-431f-be63-fa3a6d48900c"/></td></tr>
<tr><td> <em>Caption:</em> <p>username not available<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.29.49validdata.png.webp?alt=media&token=51352183-ab2e-4bd3-bce9-b332f8908dc7"/></td></tr>
<tr><td> <em>Caption:</em> <p>valid form data<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the Users table with data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T19.18.16usertable.png.webp?alt=media&token=abfd3e8a-2bd4-48f1-b391-ac7c999eb87e"/></td></tr>
<tr><td> <em>Caption:</em> <p>valid user data from task 1<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <ol><li>The form takes a username, email, and password.</li><li>Validation begins when the register button<br>is selected. The data is received and sanitized before being put into the<br>database.</li><li>First the password checked to see if it matches the confirmation, then its<br>hashed and stored in the database.</li><li>If validation is successful, the data is put<br>into the Users table.</li></ol><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Feature: User will be able to login to their account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.22.19invalidpassword.png.webp?alt=media&token=75dfd631-3820-4f66-8c80-a47ec258bd3f"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password mismatch<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.35.57nonexistinguser.png.webp?alt=media&token=3af2fed1-04c3-4497-b542-0ecc26b8dc34"/></td></tr>
<tr><td> <em>Caption:</em> <p>Nonexistent user<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of successful login</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.23.29successfullogin.png.webp?alt=media&token=3522c7f9-95fb-47df-9bcf-2609b843f02f"/></td></tr>
<tr><td> <em>Caption:</em> <p>Successful login<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <ol><li>The form takes an email and password.</li><li>Validation begins when the register button is<br>selected. The email and password are sanitized and validated.</li><li>The password entered is compared<br>with the hashed password in the database.&nbsp;</li><li>If validation is successful, the database is<br>searched for the right email.</li></ol><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Feat: Users will be able to logout </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the successful logout message</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.23.58logout.png.webp?alt=media&token=1fc31c19-4d49-4d33-84d2-51e9227692ca"/></td></tr>
<tr><td> <em>Caption:</em> <p>Successfully logged out<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the logged out user can't access a login-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.24.22notloggedin.png.webp?alt=media&token=75499b00-bf2d-49df-af9a-4327119810c8"/></td></tr>
<tr><td> <em>Caption:</em> <p>Not logged in<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>Sessions are used to securely browse the website. For login, they&#39;re used to<br>authenticate the users data across every page of the site.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Feature: Basic Security Rules Implemented / Basic Roles Implemented </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the logged out user can't access a login-protected page (may be the same as similar request)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.47.02notloggedin.png.webp?alt=media&token=1f242886-84e4-4856-b502-9e54e1a06948"/></td></tr>
<tr><td> <em>Caption:</em> <p>Not logged in<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing a user without an appropriate role can't access the role-protected page</td></tr>
<tr><td><table><tr><td>Missing Image</td></tr>
<tr><td> <em>Caption:</em> (missing)</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the Roles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T01.35.51roletable.png.webp?alt=media&token=4f47e4b0-7192-47ef-9cfe-119907484780"/></td></tr>
<tr><td> <em>Caption:</em> <p>Role table with valid role<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a screenshot of the UserRoles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T01.36.42userrole.png.webp?alt=media&token=0e62013e-04d7-4b59-abde-7dc2ab327ed9"/></td></tr>
<tr><td> <em>Caption:</em> <p>User role with valid role<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add the related pull request(s) for these features</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Explain briefly how the process/code works for login-protected pages</td></tr>
<tr><td> <em>Response:</em> <p>When a user logs out, the session clears so access to login protected<br>pages is lost.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 7: </em> Explain briefly how the process/code works for role-protected pages</td></tr>
<tr><td> <em>Response:</em> <p>The current user lacks a role that is required to view the page.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Feature: Site should have basic styles/theme applied; everything should be styled </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots to show examples of your site's styles/theme</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T02.23.45formandnav.png.webp?alt=media&token=fa7f8034-4ff3-49ac-8f16-0a7138e514ff"/></td></tr>
<tr><td> <em>Caption:</em> <p>styled nav and form<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain your CSS at a high level</td></tr>
<tr><td> <em>Response:</em> <p>To stylize the navbar I decided to give it a background and different<br>color while hovering, as well as make each nav link thicker. For now,<br>I also made each input box thicker and moved the labels on top<br>of each box.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Feature: Any output messages/errors should be "user friendly" </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of some examples of errors/messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T01.55.38invalidpassword.png.webp?alt=media&token=86fa3cda-927b-4068-9610-b78ad3495509"/></td></tr>
<tr><td> <em>Caption:</em> <p>Error 1: Invalid password login<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T01.55.43nonexistinguser.png.webp?alt=media&token=ca08800b-df37-4b25-93ab-75549503693a"/></td></tr>
<tr><td> <em>Caption:</em> <p>Error 2: Nonexistent user<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-02T01.56.37emailtaken.png.webp?alt=media&token=4ca7810f-ce81-4fbb-9ee5-8becce4ab407"/></td></tr>
<tr><td> <em>Caption:</em> <p>Error 3: Email taken<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a related pull request</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain how you made messages user friendly</td></tr>
<tr><td> <em>Response:</em> <p>The messages are user friendly because they concisely describe what the error is<br>and different message types are different colors.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Feature: Users will be able to see their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.24.52prefill.png.webp?alt=media&token=2a6e07c0-58dc-40c8-b413-d492ee8d9293"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email and username prefill<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Explain briefly how the process/code works (view only)</td></tr>
<tr><td> <em>Response:</em> <div>The username and email are retrieved, and then stored as in their respective<br>input fields.</div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Feature: User will be able to edit their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page validation messages and success messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.25.47editusername.png.webp?alt=media&token=acdd2601-32b3-4aae-858e-60765b605143"/></td></tr>
<tr><td> <em>Caption:</em> <p>username validation message<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.26.17editemail.png.webp?alt=media&token=f9bc5a12-b5c7-4fc9-91c8-40f1a2b752ea"/></td></tr>
<tr><td> <em>Caption:</em> <p>email validation<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.26.29editpassword.png.webp?alt=media&token=27e3173e-eac4-4f6d-b431-8dce07da31e1"/></td></tr>
<tr><td> <em>Caption:</em> <p>password validation<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.26.49passwordmissmatch.png.webp?alt=media&token=6a76411c-c44a-4cef-bc6c-ee7fc81dbb78"/></td></tr>
<tr><td> <em>Caption:</em> <p>password mismatch<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.26.52emailtaken.png.webp?alt=media&token=ac9a6859-417f-4ead-92db-6d987f2b4140"/></td></tr>
<tr><td> <em>Caption:</em> <p>email is taken<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add before and after screenshots of the Users table when a user edits their profile</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.27.53beforeedit.png.webp?alt=media&token=3a344737-2a78-43e7-b6ba-0f3921e1f6c4"/></td></tr>
<tr><td> <em>Caption:</em> <p>before profile edit<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fmb2297%2F2023-12-01T18.27.50afteredit.png.webp?alt=media&token=e69dead7-768a-4267-bdf4-8b4749e42c7d"/></td></tr>
<tr><td> <em>Caption:</em> <p>after profile edit<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/fisht4il/IT202-101/pull/9">https://github.com/fisht4il/IT202-101/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works (edit only)</td></tr>
<tr><td> <em>Response:</em> <p>The users username and email are prefilled in the input fields. When changes<br>are submitted an SQL statement updates the username and email in the database.<br>To change the password, the current password, new password, and password confirmation are<br>taken. The database is checked for the current password, if it exists then<br>an SQL statement updates the password in the database.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 9: </em> Issues and Project Board </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707795-a9c94a71-7871-4572-bfae-ad636f8f8474.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed</td></tr>
<tr><td><table><tr><td>Missing Image</td></tr>
<tr><td> <em>Caption:</em> (missing)</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Include a direct link to your Project Board</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 3: </em> Prod Application Link to Login Page</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-101-F23/it202-milestone1-deliverable/grade/mb2297" target="_blank">Grading</a></td></tr></table>