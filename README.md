# takemailer

1. Created HTTP POST request to send email with following params in body as json
{
	"to": "szubair01@gmail.com",
	"subject":"Welcome to HR (TAKEAWAY.com)",
	"message":"Dear Sharjeel Zubair, we like the way you code you are now on board with us and we hope that you will make us proud!"
}
2. The Email controller will take the params and save the email object in DB , and dispatch a job to send email
3. Used interfaces for both mailjet and sendgrid, in one interface I am resolving client by giving keys and secrets and then in other interface sending emails via both of them, An email service provider was added so if you need to add you own in later you can . **
         * Create singleton for bootstarpping the Mailers to be used across the application
         * If a new mailer is added it should be added here as well
         */
4. Using database queue as its easy to configure and get runnig
5. In job handel I am adding both classes for mailers, below is my consideration
 /**
         * 
         * I think here if we have an array of mail senders, then we can loop through them and if first gives false
         * we move to second, and so on. without having if else
         * 
         * But I am not able to do just that, How to get thoses mailers as an array seems out of my knowledge
         * 
         * We can bind multiple implementations to same interface in this context the Mailsender interface
         * 
         * I believe ther is sometthing we can do with appservice provider to bind classes with interfaces
         */
6. So it will try sending with one mailer (mailjet first) and if it returns false , it will send with other (Sendgrid)

# Send grid blocked my account for some reason!

7. How to add new mailer?  lets suppose (sendinblue)
    a. in email service provider , create mailer clients class object of sendinblue
    b. pass some config values if required
    c. create sendinblueclient.php in mailer which implements mailclient
    d. create sendinbluesender.php in mailer which implements Mailsender
    e. add sendingbluesender in job and add a check for this if sendgrid fails opt this new one
8. I am logging the emails in larave.log file (I created a model name log to save logs to database, and then from there I can retrievet them and show them on vuejs page with status) 
there is a way of creating channels to do custom logging, but im not aware of it

9. Create docker file and docker compose to run all the configurations required ( I am using windows , docker is very unstable on it, mysql service was running but app(takeawaymailerloca)) exits with no logs)

10. added a console command send:email to send email interactively with data validation

11. wrote few unit tests along with the development, there can be many more tests but wrote to the point

12. for now we need to run php artisan queue:work to listen the jobs, but this can be in backrgound by installing supervisor on server


13. added vue page for fetching the queues

Limited experience in docker restricted me to do the scale thing.
I am sure I a can do better than this , but with lesser experienece in above kind of thing makes me a little offroad
I am sure that under good supervision and keen to learn attitude I can build more like this with better ways



