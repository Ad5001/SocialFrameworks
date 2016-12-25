<?php
error_reporting(-1);

class TwitterAccount {
	
	
	
	/*
    Constructs the class
    @param     $account      string
    */
	
	public function __construct(string $account) {
		
		$this->account = $account;

        $ret = file_get_contents("http://twitter.com/$account");
		$ret = explode("\n", $ret);
		$ret = $ret[89];
		if(strpos($ret, '      <input type="hidden" id="init-data" class="json-data" value="') !== false) {
			$ret = substr($ret, 67);
			$ret = substr($ret, 0, strlen($ret) - 2);
			$ret = str_ireplace("&quot;", '"', $ret);
            $this->data = json_decode($ret, true)["profile_user"];
		} else {
            echo "Could not fing data about account $account";
        }
	}


    /*
    Return the name of the user (the one shown as the name, not the one with a @ which is the screen name)
    @return string
    */
    public function getName() : string {
        return $this->data["name"];
    }


    /*
    Returns the screen name of the user: the name with the @.
    @return string
    */
    public function getScreenName() : string {
        return $this->data["screen_name"];
    }


    /*
    Returns the description
    @return string
    */
    public function getDescription() : string {
        return $this->data["description"];
    }


    /*
    Returns user location if specified
    @return string
    */
    public function getLocation() : string {
        return isset($this->data["location"]) ? $this->data["location"] : "";
    }


    /*
    Returns user's followers
    @return string
    */
    public function getFollowersCount() : string {
        return $this->data["followers_count"];
    }


    /*
    Returns user's following count
    @return string
    */
    public function getFollowingCount() : string {
        return $this->data["friends_count"];
    }


    /*
    Returns account creation date
    @return string
    */
    public function getCreationDate() : string {
        return $this->data["created_at"];
    }


    /*
    Returns URL if specified
    @return string
    */
    public function getPage() : string {
        return isset($this->data["url"]) ? $this->data["url"] : "";
    }


    /*
    Returns count of lists in which is user
    @return string
    */
    public function getLists() : string {
        return $this->data["listed_count"];
    }


    /*
    Returns count of lists in which is user
    @return string
    */
    public function getLang() : string {
        return $this->data["lang"];
    }
}


if(isset($_GET["request"]) && isset($_GET["account"])) {
    $acc = new TwitterAccount($_GET["account"]);
    echo $acc->data[$_GET["request"]];
}