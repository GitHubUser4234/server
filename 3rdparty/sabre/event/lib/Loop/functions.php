<?php

namespace Sabre\Event\Loop;

/**
 * Executes a function after x seconds.
 *
 * @param callable $cb
 * @param float $timeout timeout in seconds
 * @return void
 */
function setTimeout(callable $cb, $timeout) {

    instance()->setTimeout($cb, $timeout);

}

/**
 * Executes a function every x seconds.
 *
 * The value this function returns can be used to stop the interval with
 * clearInterval.
 *
 * @param callable $cb
 * @param float $timeout
 * @return array
 */
function setInterval(callable $cb, $timeout) {

    return instance()->setInterval($cb, $timeout);

}

/**
 * Stops a running internval.
 *
 * @param array $intervalId
 * @return void
 */
function clearInterval($intervalId) {

    instance()->clearInterval($intervalId);

}

/**
 * Runs a function immediately at the next iteration of the loop.
 *
 * @param callable $cb
 * @return void
 */
function nextTick(callable $cb) {

    instance()->nextTick($cb);

}


/**
 * Adds a read stream.
 *
 * The callback will be called as soon as there is something to read from
 * the stream.
 *
 * You MUST call removeReadStream after you are done with the stream, to
 * prevent the eventloop from never stopping.
 *
 * @param resource $stream
 * @param callable $cb
 * @return void
 */
function addReadStream($stream, callable $cb) {

    instance()->addReadStream($stream, $cb);

}

/**
 * Adds a write stream.
 *
 * The callback will be called as soon as the system reports it's ready to
 * receive writes on the stream.
 *
 * You MUST call removeWriteStream after you are done with the stream, to
 * prevent the eventloop from never stopping.
 *
 * @param resource $stream
 * @param callable $cb
 * @return void
 */
function addWriteStream($stream, callable $cb) {

    instance()->addWriteStream($stream, $cb);

}

/**
 * Stop watching a stream for reads.
 *
 * @param resource $stream
 * @return void
 */
function removeReadStream($stream) {

    instance()->removeReadStream($stream);

}

/**
 * Stop watching a stream for writes.
 *
 * @param resource $stream
 * @return void
 */
function removeWriteStream($stream) {

    instance()->removeWriteStream($stream);

}


/**
 * Runs the loop.
 *
 * This function will run continiously, until there's no more events to
 * handle.
 *
 * @return void
 */
function run() {

    instance()->run();

}

/**
 * Executes all pending events.
 *
 * If $block is turned true, this function will block until any event is
 * triggered.
 *
 * If there are now timeouts, nextTick callbacks or events in the loop at
 * all, this function will exit immediately.
 *
 * This function will return true if there are _any_ events left in the
 * loop after the tick.
 *
 * @param bool $block
 * @return bool
 */
function tick($block = false) {

    return instance()->tick($block);

}

/**
 * Stops a running eventloop
 *
 * @return void
 */
function stop() {

    instance()->stop();

}

/**
 * Retrieves or sets the global Loop object.
 *
 * @param Loop $newLoop
 */
function instance(Loop $newLoop = null) {

    static $loop;
    if ($newLoop) {
        $loop = $newLoop;
    } elseif (!$loop) {
        $loop = new Loop();
    }
    return $loop;

}
