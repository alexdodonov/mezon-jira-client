<?php
namespace Mezon\Jira;

/**
 * Repository with Jira projects
 *
 * @author gdever
 */
class ProjectsRepository extends ArrayObject
{

    /**
     * Connection to Jira
     *
     * @var Connection
     */
    private $connection = null;

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Method loads list of projects from server
     */
    public function loadProjects(): void
    {
        // initial setup
        $result = [];
        $startAt = 0;

        // main loop
        do {
            // reading data
            $page = $this->connection->sendGetRequest('/project/search/?startAt=' . $startAt);

            // additing read projects to the previous ones
            $result = array_merge($result, $page->values);

            // shifting on the next page
            $startAt += 50;
        } while (! $page->isLast);

        // make objects
        foreach ($result as $key => $project) {
            $result[$key] = new Project($this->connection, $project);
        }
        $this->exchangeArray($result);
    }
}
