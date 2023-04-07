<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class Validator {
    public const VALIDATION_TYPES = ['type', 'nullable', 'empty', 'choice'];

    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function setRequest(Request $request) {
        try {
            $this->request = $request;
            $this->data = (array) json_decode($request->getContent());
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Invalid JSON body.');
        }
    }

    public function object($id = null, $class = null) {
        if ($id) {
            $result = $this->em->getRepository($class)->findOneBy(['id' => $id]);
            if (!$result) {
                throw new \InvalidArgumentException(sprintf('%s %s does not exist.', $class, $id));
            }

            return $result;
        } else {
            return null;
        }
    }

    public function id($id = null, $class = null) {
        if ($id) {
            $result = $this->em->getRepository($class)->findOneBy(['id' => $id]);
            if (!$result) {
                throw new \InvalidArgumentException(sprintf('%s %s does not exist.', $class, $id));
            }

            return $result->getId();
        } else {
            return Uuid::uuid4();
        }
    }

    public function __call($name, $arguments) {
        $keys = array_keys($arguments);
        $arguments['nullable'] = $arguments['nullable'] ?? false;
        $arguments['empty'] = $arguments['empty'] ?? false;

        if (!in_array($name, array_keys($this->data))) {
            throw new \InvalidArgumentException(sprintf('%s is not configured.', $name));
        }
        try {
            if (gettype($this->data[$name]) != $arguments['type']) {
                throw new \InvalidArgumentException(sprintf('%s needs to be of type %s.', $name, $arguments['type']));
            }
            if (in_array('nullable', $keys)) {
                if (!$arguments['nullable']) {
                    if (null == $this->data[$name]) {
                        throw new \InvalidArgumentException(sprintf('%s cannot be null.', $name));
                    }
                }
            }
            if (in_array('empty', $keys)) {
                if ($arguments['empty']) {
                    if (empty($this->data[$name])) {
                        throw new \InvalidArgumentException(sprintf('%s cannot be empty.', $name));
                    }
                }
            }
            if (in_array('choice', $keys)) {
                if (!in_array($this->data[$name], $arguments['choice'])) {
                    throw new \InvalidArgumentException(sprintf('%s is not accepted.', json_encode($this->data[$name])));
                }
            }
        } catch (\TypeError $e) {
            throw new \InvalidArgumentException(sprintf('%s produced type error', $name));
        } catch (\InvalidArgumentException $e) {
            throw $e;
        } catch (\Error $e) {
            print_r($name);
            exit;
        }

        return $this->data[$name];
    }
}
