<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Preview
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Preview\DeployedDevices\Fleet;

use Twilio\Exceptions\TwilioException;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;


class CertificateContext extends InstanceContext
    {
    /**
     * Initialize the CertificateContext
     *
     * @param Version $version Version that contains the resource
     * @param string $fleetSid 
     * @param string $sid Provides a 34 character string that uniquely identifies the requested Certificate credential resource.
     */
    public function __construct(
        Version $version,
        $fleetSid,
        $sid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'fleetSid' =>
            $fleetSid,
        'sid' =>
            $sid,
        ];

        $this->uri = '/Fleets/' . \rawurlencode($fleetSid)
        .'/Certificates/' . \rawurlencode($sid)
        .'';
    }

    /**
     * Delete the CertificateInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->version->delete('DELETE', $this->uri);
    }


    /**
     * Fetch the CertificateInstance
     *
     * @return CertificateInstance Fetched CertificateInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): CertificateInstance
    {

        $payload = $this->version->fetch('GET', $this->uri, [], []);

        return new CertificateInstance(
            $this->version,
            $payload,
            $this->solution['fleetSid'],
            $this->solution['sid']
        );
    }


    /**
     * Update the CertificateInstance
     *
     * @param array|Options $options Optional Arguments
     * @return CertificateInstance Updated CertificateInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): CertificateInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'FriendlyName' =>
                $options['friendlyName'],
            'DeviceSid' =>
                $options['deviceSid'],
        ]);

        $payload = $this->version->update('POST', $this->uri, [], $data);

        return new CertificateInstance(
            $this->version,
            $payload,
            $this->solution['fleetSid'],
            $this->solution['sid']
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.DeployedDevices.CertificateContext ' . \implode(' ', $context) . ']';
    }
}