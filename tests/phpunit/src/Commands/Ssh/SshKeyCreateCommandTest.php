<?php

namespace Acquia\Cli\Tests\Commands\Ssh;

use Acquia\Cli\Command\Ssh\SshKeyCreateCommand;
use Acquia\Cli\Helpers\LocalMachineHelper;
use Acquia\Cli\Tests\CommandTestBase;
use Symfony\Component\Console\Command\Command;

class SshKeyCreateCommandTest extends CommandTestBase {

  /**
   * {@inheritdoc}
   */
  protected function createCommand(): Command {
    return new SshKeyCreateCommand();
  }

  /**
   * Tests the 'ssh-key:create' command.
   *
   * @throws \Psr\Cache\InvalidArgumentException
   */
  public function testCreate(): void {
    $ssh_key_filename = 'id_rsa_acli_test';
    // @todo Change the default ssh key dir for testing.
    $ssh_key_filepath = LocalMachineHelper::getHomeDir() . '/.ssh/' . $ssh_key_filename;
    $this->fs->remove($ssh_key_filepath);

    $inputs = [
        // Please enter a filename for your new local SSH key:
      $ssh_key_filename,
          // Enter a password for your SSH key:
      'acli123',
    ];
    $this->executeCommand([], $inputs);
    $this->assertFileExists($ssh_key_filepath);
    $this->assertFileExists($ssh_key_filepath . '.pub');
  }

}
