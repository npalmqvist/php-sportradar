<?php
/**
 * @author Niklas Palmqvist <niklas@decisign.se>
 */

namespace SportsData;
use SportsData\SportsData;
//require_once 'SportsData.php';


class SportsDataHandball extends SportsData {

	private $base_url = "api.sportradar.com/handball-";
	private $language; //  any valid ISO-646 language code
	private $version; // Whole number (sequential, starting with the number 1)

	public function __construct($api_key,$version,$access_level,$language = 'sv',$format = 'json',$secure = false) {
		$this->api_key = $api_key;
		$this->version = $this->check_version($version);
		$this->access_level = $this->check_access_level($access_level);
		$this->language = $language;
		$this->format = $this->check_format($format);
		$this->url_protocol = $secure ? 'https://' : 'http://';
	}

	private function check_version($version) {
		if(!is_int($version)) throw new Exception('Version is invalid. Must be whole number');
		return $version;
	}

	/**
	* Provides information for a given competitor
	* https://developer.sportradar.com/files/indexHandball.html#competitor-profile
	**/
	public function competitor_profile($competitor_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/competitors/'.$competitor_id.'/profile.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides past match results for a given competitor
	* https://developer.sportradar.com/files/indexHandball.html#competitor-results
	**/
	public function competitor_results($competitor_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/competitors/'.$competitor_id.'/results.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the schedule for a given competitor
	* https://developer.sportradar.com/files/indexHandball.html#competitor-schedule
	**/
	public function competitor_schedule($competitor_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/competitors/'.$competitor_id.'/schedule.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the match scoring for all matches played on a given day
	* https://developer.sportradar.com/files/indexHandball.html#daily-results
	* @param date $date (YYY-MM-DD)
	**/
	public function daily_results($date) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/schedules/'.$date.'/results.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the schedule for all matches played on a given day
	* https://developer.sportradar.com/files/indexHandball.html#daily-schedule
	* @param date $date (YYY-MM-DD)
	**/
	public function daily_schedule($date) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/schedules/'.$date.'/schedule.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides team versus team data (competitor vs competitor)
	* https://developer.sportradar.com/files/indexHandball.html#head-to-head
	* @param string $c1 Competitor Id
	* @param string $c2 Competitor Id
	**/
	public function head_to_head($c1, $c2) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/competitors/'.$c1.'/versus/'.$c2.'/matches.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides a list of matches in progress
	**/
	public function live_schedule() {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/schedules/live/schedule.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the seasons for a given Tournament
	* https://developer.sportradar.com/files/indexHandball.html#seasons
	* @param string $tournament_id
	**/
	public function seasons($tournament_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments/'.$tournament_id.'/seasons.'.$this->format.'?api_key='.$this->api_key;
		var_dump($this->send_url);
		return $this->curl($this->send_url);
	}

	/**
	* Provides probabilities for a given match; prematch only
	* https://developer.sportradar.com/files/indexHandball.html#sport-event-probabilities
	* @param string $match_id
	**/
	public function sport_event_probabilities($match_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/matches/'.$match_id.'/probabilities.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides detailed information for a given match
	* https://developer.sportradar.com/files/indexHandball.html#sport-event-timeline
	* @param string $match_id
	**/
	public function sport_event_timeline($match_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/matches/'.$match_id.'/timeline.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides a list of Competitors from a given Tournament
	* https://developer.sportradar.com/files/indexHandball.html#tournament-info
	* @param string $tournament_id
	**/
	public function tournament_info($tournament_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments/'.$tournament_id.'/info.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides a list of all tournaments
	* https://developer.sportradar.com/files/indexHandball.html#tournament-list
	**/
	public function tournament_list() {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the live standings for a given Tournament
	* https://developer.sportradar.com/files/indexHandball.html#tournament-live-standings
	* @param string $tournament_id
	**/
	public function tournament_live_standings($tournament_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments/'.$tournament_id.'/live_standings.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the results for a given tournament
	* https://developer.sportradar.com/files/indexHandball.html#tournament-results
	* @param string $tournament_id
	**/
	public function tournament_results($tournament_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments/'.$tournament_id.'/results.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the schedule for a given Tournament
	* https://developer.sportradar.com/files/indexHandball.html#tournament-schedule
	* @param string $tournament_id
	**/
	public function tournament_schedule($tournament_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments/'.$tournament_id.'/schedule.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

	/**
	* Provides the standings for a given Tournament
	* https://developer.sportradar.com/files/indexHandball.html#tournament-standings
	* @param string $tournament_id
	**/
	public function tournament_standings($tournament_id) {
		$this->send_url = $this->base_url.$this->access_level.$this->version.'/'.$this->language.'/tournaments/'.$tournament_id.'/standings.'.$this->format.'?api_key='.$this->api_key;
		return $this->curl($this->send_url);
	}

}
