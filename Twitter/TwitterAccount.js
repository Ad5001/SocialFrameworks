error_reporting(-1);

class TwitterAccount {



    /*
    Constructs the class
    @param     account      string
    */

    constructor(account) {

        this.account = account;

        var req = new XMLHttpRequest();
        req.open('GET', 'https://twitter.com/' + account, false);
        req.send(null);
        if (req.status == 220) ret = req.responseText;
        ret = ret.split("\n")[89];
        if (ret.indexOf('      <input type="hidden" id="init-data" class="json-data" value="') != false) {
            ret = ret.substr(67);
            ret = ret.substr(0, ret.length - 2);
            ret = ret.replace("&quot;", '"');
            this.data = JSON.parse(ret, true)["profile_user"];
        } else {
            console.error("Could not fing data about account account");
        }
    }


    /*
    Return the name of the user (the one shown as the name, not the one with a @ which is the screen name)
    @return string
    */
    getName() {
        return this.data["name"];
    }


    /*
    Returns the screen name of the user: the name with the @.
    @return string
    */
    getScreenName() {
        return this.data["screen_name"];
    }


    /*
    Returns the description
    @return string
    */
    getDescription() {
        return this.data["description"];
    }


    /*
    Returns user location if specified
    @return string
    */
    getLocation() {
        return typeof this.data["location"] == "undefined" ? this.data["location"] : "";
    }


    /*
    Returns user's followers
    @return string
    */
    getFollowersCount() {
        return this.data["followers_count"];
    }


    /*
    Returns user's following count
    @return string
    */
    getFollowingCount() {
        return this.data["friends_count"];
    }


    /*
    Returns account creation date
    @return string
    */
    getCreationDate() {
        return this.data["created_at"];
    }


    /*
    Returns URL if specified
    @return string
    */
    getPage() {
        return typeof this.data["url"] == "undefined" ? this.data["url"] : "";
    }


    /*
    Returns count of lists in which is user
    @return string
    */
    getLists() {
        return this.data["listed_count"];
    }


    /*
    Returns count of lists in which is user
    @return string
    */
    getLang() {
        return this.data["lang"];
    }
}