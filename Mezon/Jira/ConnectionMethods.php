<?php
namespace Mezon\Jira;

/**
 * Connection to JIRA methods
 *
 * @author gdever
 */
trait ConnectionMethods
{

    /**
     * Connection to Jira
     *
     * @var Connection
     */
    private $connection = null;

    /**
     * Method returns connection to Jira
     *
     * @return Connection connection to Jira
     */
    protected function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * Method returns connection to Jira
     *
     * @param Connection $connection
     *            connection to Jira
     */
    protected function setConnection(Connection $connection): void
    {
        $this->connection = $connection;
    }
}
