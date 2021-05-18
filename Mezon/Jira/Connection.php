<?php
namespace Mezon\Jira;

use Mezon\CustomClient\CustomClient;

/**
 * Connection to JIRA
 *
 * @author gdever
 */
class Connection
{

    /**
     * Connection to API
     *
     * @var CustomClient
     */
    private $connection = null;

    /**
     * Connection to the Jira REST API
     *
     * @param string $url
     *            jira server URL
     * @param string $login
     *            user login
     * @param string $token
     *            access token. See this page https://confluence.atlassian.com/cloud/api-tokens-938839638.html for more information
     */
    public function __construct(string $url = '', string $login = '', string $token = '')
    {
        if ($url !== '') {
            $this->connect($url, $login, $token);
        }
    }

    /**
     * Connection to the Jira REST API
     *
     * @param string $url
     *            jira server URL
     * @param string $login
     *            user login
     * @param string $token
     *            access token. See this page https://confluence.atlassian.com/cloud/api-tokens-938839638.html for more information
     */
    public function connect(string $url, string $login, string $token): void
    {
        $this->connection = new CustomClient($url, [
            'Authorization: Basic ' . base64_encode($login . ':' . $token),
            'Content-type: application/json'
        ]);
    }

    /**
     * Method sends GET request to Jira server
     *
     * @param string $endpoint
     *            endpoint to REST method
     * @return object result
     */
    public function sendGetRequest(string $endpoint): object
    {
        return json_decode($this->connection->sendGetRequest($endpoint), false);
    }

    /**
     * Method sends POST request to Jira server
     *
     * @param string $endpoint
     *            endpoint to REST method
     * @param array $data
     *            data to be sent
     * @return object result
     */
    public function sendPostRequest(string $endpoint, array $data): object
    {
        return json_decode($this->connection->sendPostRequest($endpoint, $data), false);
    }
}
