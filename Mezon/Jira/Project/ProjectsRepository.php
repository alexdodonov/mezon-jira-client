<?php
namespace Mezon\Jira\Project;

use Mezon\Jira\Connection;
use Mezon\Jira\PageReader;
use Mezon\Jira\ConnectionMethods;

/**
 * Repository with Jira projects
 *
 * @author gdever
 */
class ProjectsRepository extends \ArrayObject
{
    
    use PageReader, ConnectionMethods;

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     */
    public function __construct(Connection $connection)
    {
        $this->setConnection($connection);
    }

    /**
     * Method loads list of projects from server
     */
    public function loadProjects(): void
    {
        $result = $this->readAllPages('/project/search/?startAt=');

        // make objects
        foreach ($result as $key => $project) {
            $result[$key] = new Project($this->connection, $project);
        }
        $this->exchangeArray($result);
    }
}
