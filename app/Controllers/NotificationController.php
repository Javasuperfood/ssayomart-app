<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use CodeIgniter\Controller;

class NotificationController extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    public function getUnreadCount()
    {
        $adminUserId = user_id();
        $count = $this->notificationModel->where(['id_user' => $adminUserId, 'is_read' => 0])->countAllResults();
        return $this->response->setJSON(['count' => $count]);
    }

    public function getNotifications()
    {
        $adminUserId = user_id();
        $notifications = $this->notificationModel->where('id_user', $adminUserId)->orderBy('created_at', 'DESC')->findAll(10);
        return $this->response->setJSON(['notifications' => $notifications]);
    }

    public function markAsRead($id)
    {
        $adminUserId = user_id();
        $notification = $this->notificationModel->find($id);

        if (!$notification) {
            log_message('error', "Notification ID {$id} not found.");
            return $this->response->setJSON(['status' => 'error', 'message' => 'Notification not found.'], 404);
        }

        if ($notification['id_user'] != $adminUserId) {
            log_message('error', "User ID mismatch for Notification ID {$id}.");
            return $this->response->setJSON(['status' => 'error', 'message' => 'User mismatch.'], 403);
        }

        $this->notificationModel->update($id, ['is_read' => 1]);
        log_message('info', "Notification ID {$id} marked as read by admin ID {$adminUserId}");
        return $this->response->setJSON(['status' => 'success', 'newToken' => csrf_hash()]);
    }

    public function markAllAsRead()
    {
        $adminUserId = user_id();
        $this->notificationModel->where(['id_user' => $adminUserId, 'is_read' => 0])->set(['is_read' => 1])->update();
        log_message('info', "All notifications marked as read by admin ID {$adminUserId}");
        return $this->response->setJSON(['status' => 'success', 'newToken' => csrf_hash()]);
    }
}
