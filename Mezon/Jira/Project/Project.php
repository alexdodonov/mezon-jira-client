<?php
namespace Mezon\Jira\Project;

use Mezon\Jira\ConnectionMethods;
use Mezon\Jira\Connection;

/**
 * Jira project
 *
 * @author gdever
 */
class Project
{

    use ConnectionMethods;

    /**
     * Project data
     *
     * @var object
     */
    private $project = null;

    /**
     * List of scalar fields
     *
     * @var array
     */
    private $scalarFields = [
        'id',
        'key',
        'name',
        'isPrivate',
        'projectTypeKey',
        'style'
    ];

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     * @param object $project
     *            data
     */
    public function __construct(Connection $connection, object $project)
    {
        $this->setConnection($connection);

        $this->project = $project;
    }

    /**
     * Method returns fields
     *
     * @param string $name
     *            field name
     * @return mixed field falue
     */
    public function __get(string $name)
    {
        if (in_array($name, $this->scalarFields)) {
            return $this->project->$name;
        }

        return null;
    }
}
