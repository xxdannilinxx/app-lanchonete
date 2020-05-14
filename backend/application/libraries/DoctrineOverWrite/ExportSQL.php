<?php

namespace DoctrineOverWrite;

defined('BASEPATH') or exit('No direct script access allowed');

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * A SQL logger that logs to the standard output using echo/var_dump.
 *
 * 
 * @link    www.doctrine-project.org
 * @since   2.0
 * @version $Revision$
 * @author  Benjamin Eberlei <kontakt@beberlei.de>
 * @author  Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author  Jonathan Wage <jonwage@gmail.com>
 * @author  Roman Borschel <roman@code-factory.org>
 */
class ExportSQL implements SQLLogger
{

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null): void
    {
        debug("SQL_QUERY: {$sql}");
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery(): void
    {

    }

}
