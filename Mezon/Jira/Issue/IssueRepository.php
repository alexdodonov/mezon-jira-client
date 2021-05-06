<?php
namespace Mezon\Jira\Issue;

use Mezon\Jira\PageReader;
use Mezon\Jira\ConnectionMethods;
use Mezon\Jira\Project\Project;
use Mezon\Jira\Connection;

/**
 * Repository with Jira issues
 *
 * @author gdever
 */
class IssueRepository extends \ArrayObject
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
}
