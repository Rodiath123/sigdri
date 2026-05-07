import 'package:flutter/material.dart';

class NotificationsScreen extends StatelessWidget {
  const NotificationsScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        title: const Text(
          'Notifications',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        backgroundColor: const Color(0xFF1a3a5c),
        foregroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios),
          onPressed: () => Navigator.pop(context),
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.checklist),
            onPressed: () {
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(
                  content: Text('Marquer toutes comme lues'),
                  duration: Duration(seconds: 1),
                ),
              );
            },
          ),
        ],
      ),
      body: Column(
        children: [
          // Header avec illustration
          Container(
            width: double.infinity,
            decoration: BoxDecoration(
              gradient: const LinearGradient(
                colors: [Color(0xFF1a3a5c), Color(0xFF2563eb)],
              ),
              borderRadius: const BorderRadius.only(
                bottomLeft: Radius.circular(30),
                bottomRight: Radius.circular(30),
              ),
            ),
            padding: const EdgeInsets.all(30),
            child: Column(
              children: [
                Container(
                  padding: const EdgeInsets.all(15),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.2),
                    shape: BoxShape.circle,
                  ),
                  child: const Icon(
                    Icons.notifications_active,
                    color: Colors.white,
                    size: 40,
                  ),
                ),
                const SizedBox(height: 16),
                const Text(
                  'Vos notifications',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 8),
                Text(
                  'Vous avez 4 notifications non lues',
                  style: TextStyle(
                    color: Colors.white.withOpacity(0.8),
                    fontSize: 13,
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 16),

          // Liste des notifications
          Expanded(
            child: ListView.builder(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
              itemCount: 8,
              itemBuilder: (context, index) {
                return _buildNotificationItem(
                  title: index == 0 
                    ? '✅ Déclaration validée' 
                    : index == 1 
                      ? '📅 Rappel déclaration' 
                      : index == 2 
                        ? '⚠️ Document manquant' 
                        : '📊 Rapport mensuel disponible',
                  message: index == 0 
                    ? 'Votre déclaration #2025001 a été validée par le ministère'
                    : index == 1 
                      ? 'Nouveau trimestre : pensez à soumettre votre déclaration avant le 30'
                      : index == 2 
                        ? 'Veuillez fournir le document justificatif pour votre déclaration'
                        : 'Le rapport statistique du mois est disponible en téléchargement',
                  time: index == 0 
                    ? 'Il y a 2 heures' 
                    : index == 1 
                      ? 'Il y a 1 jour' 
                      : index == 2 
                        ? 'Il y a 3 jours' 
                        : 'Il y a 5 jours',
                  isRead: index > 1,
                  onTap: () {
                    _showNotificationDetail(context, index);
                  },
                );
              },
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildNotificationItem({
    required String title,
    required String message,
    required String time,
    required bool isRead,
    required VoidCallback onTap,
  }) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      child: Material(
        color: isRead ? Colors.white : const Color(0xFF1a3a5c).withOpacity(0.03),
        borderRadius: BorderRadius.circular(16),
        elevation: 0,
        child: InkWell(
          onTap: onTap,
          borderRadius: BorderRadius.circular(16),
          child: Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: isRead ? Colors.white : const Color(0xFF1a3a5c).withOpacity(0.03),
              borderRadius: BorderRadius.circular(16),
              border: isRead 
                ? Border.all(color: Colors.grey.shade100)
                : Border.all(color: const Color(0xFFf97316).withOpacity(0.3)),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.03),
                  blurRadius: 10,
                  offset: const Offset(0, 2),
                ),
              ],
            ),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Icône
                Container(
                  padding: const EdgeInsets.all(10),
                  decoration: BoxDecoration(
                    color: title.contains('✅') 
                      ? Colors.green.withOpacity(0.1)
                      : title.contains('📅')
                        ? const Color(0xFFf97316).withOpacity(0.1)
                        : title.contains('⚠️')
                          ? Colors.orange.withOpacity(0.1)
                          : Colors.blue.withOpacity(0.1),
                    shape: BoxShape.circle,
                  ),
                  child: Text(
                    title.contains('✅') 
                      ? '✅' 
                      : title.contains('📅')
                        ? '📅'
                        : title.contains('⚠️')
                          ? '⚠️'
                          : '📊',
                    style: const TextStyle(fontSize: 20),
                  ),
                ),
                const SizedBox(width: 12),

                // Contenu
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        title,
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 14,
                          color: isRead ? Colors.black87 : const Color(0xFF1a3a5c),
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        message,
                        style: TextStyle(
                          fontSize: 12,
                          color: Colors.grey[600],
                        ),
                        maxLines: 2,
                        overflow: TextOverflow.ellipsis,
                      ),
                      const SizedBox(height: 8),
                      Row(
                        children: [
                          Icon(Icons.access_time, size: 12, color: Colors.grey[400]),
                          const SizedBox(width: 4),
                          Text(
                            time,
                            style: TextStyle(
                              fontSize: 11,
                              color: Colors.grey[500],
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),

                // Badge non lu
                if (!isRead)
                  Container(
                    width: 8,
                    height: 8,
                    decoration: const BoxDecoration(
                      color: Color(0xFFf97316),
                      shape: BoxShape.circle,
                    ),
                  ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  void _showNotificationDetail(BuildContext context, int index) {
    showModalBottomSheet(
      context: context,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      builder: (context) {
        return Container(
          padding: const EdgeInsets.all(24),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Center(
                child: Container(
                  width: 40,
                  height: 4,
                  decoration: BoxDecoration(
                    color: Colors.grey[300],
                    borderRadius: BorderRadius.circular(2),
                  ),
                ),
              ),
              const SizedBox(height: 24),
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: const Color(0xFF1a3a5c).withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: Text(
                  index == 0 ? '✅' : index == 1 ? '📅' : index == 2 ? '⚠️' : '📊',
                  style: const TextStyle(fontSize: 28),
                ),
              ),
              const SizedBox(height: 16),
              Text(
                index == 0 
                  ? 'Déclaration validée' 
                  : index == 1 
                    ? 'Rappel déclaration' 
                    : index == 2 
                      ? 'Document manquant' 
                      : 'Rapport mensuel',
                style: const TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 12),
              Text(
                index == 0 
                  ? 'Votre déclaration trimestrielle a été examinée et validée par les services du ministère. Vous pouvez consulter le récépissé dans votre espace.'
                  : index == 1 
                    ? 'Le nouveau trimestre a débuté. Veuillez soumettre votre déclaration de production avant le 30 du mois.'
                    : index == 2 
                      ? 'Un document justificatif est manquant dans votre dossier. Veuillez le fournir rapidement pour finaliser votre déclaration.'
                      : 'Le rapport statistique du mois est disponible. Consultez les indicateurs clés de votre secteur.',
                style: TextStyle(color: Colors.grey[600], height: 1.5),
              ),
              const SizedBox(height: 24),
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () => Navigator.pop(context),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFFf97316),
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(vertical: 14),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                  ),
                  child: const Text('Fermer'),
                ),
              ),
              const SizedBox(height: 16),
            ],
          ),
        );
      },
    );
  }
}