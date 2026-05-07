import 'package:flutter/material.dart';

class HistoryScreen extends StatelessWidget {
  const HistoryScreen({super.key, this.filter = 'tous'});
  final String filter;

  @override
  Widget build(BuildContext context) {
    final declarations = _getDeclarations(filter);
    
    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        title: Text(
          filter == 'en_attente' 
            ? 'Déclarations en attente' 
            : filter == 'validees' 
              ? 'Déclarations validées' 
              : 'Historique',
          style: const TextStyle(fontWeight: FontWeight.bold),
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
            icon: const Icon(Icons.filter_list),
            onPressed: () {
              _showFilterDialog(context);
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
                    Icons.history,
                    color: Colors.white,
                    size: 40,
                  ),
                ),
                const SizedBox(height: 16),
                const Text(
                  'Historique des déclarations',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 8),
                Text(
                  '${declarations.length} déclaration${declarations.length > 1 ? 's' : ''} trouvée${declarations.length > 1 ? 's' : ''}',
                  style: TextStyle(
                    color: Colors.white.withOpacity(0.8),
                    fontSize: 13,
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 16),
          
          // Liste des déclarations
          Expanded(
            child: declarations.isEmpty
              ? Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(Icons.inbox, size: 80, color: Colors.grey[300]),
                      const SizedBox(height: 16),
                      Text(
                        'Aucune déclaration',
                        style: TextStyle(color: Colors.grey[500]),
                      ),
                    ],
                  ),
                )
              : ListView.builder(
                  padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  itemCount: declarations.length,
                  itemBuilder: (context, index) {
                    final dec = declarations[index];
                    return _buildDeclarationCard(context, dec);
                  },
                ),
          ),
        ],
      ),
    );
  }

  Widget _buildDeclarationCard(BuildContext context, Map<String, dynamic> declaration) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      child: Material(
        color: Colors.transparent,
        borderRadius: BorderRadius.circular(16),
        child: InkWell(
          onTap: () => _showDetailDialog(context, declaration),
          borderRadius: BorderRadius.circular(16),
          child: Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(16),
              border: Border.all(
                color: declaration['status'] == 'en_attente' 
                  ? Colors.orange.withOpacity(0.3)
                  : Colors.green.withOpacity(0.3),
              ),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.03),
                  blurRadius: 10,
                  offset: const Offset(0, 2),
                ),
              ],
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    // Statut
                    Container(
                      padding: const EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: declaration['status'] == 'en_attente'
                            ? Colors.orange.withOpacity(0.1)
                            : Colors.green.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Icon(
                        declaration['status'] == 'en_attente' 
                          ? Icons.pending 
                          : Icons.check_circle,
                        color: declaration['status'] == 'en_attente' 
                          ? Colors.orange 
                          : Colors.green,
                        size: 20,
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            declaration['title'],
                            style: const TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                            ),
                          ),
                          Text(
                            declaration['date'],
                            style: TextStyle(
                              fontSize: 12,
                              color: Colors.grey[500],
                            ),
                          ),
                        ],
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                      decoration: BoxDecoration(
                        color: declaration['status'] == 'en_attente'
                            ? Colors.orange.withOpacity(0.1)
                            : Colors.green.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        declaration['status'] == 'en_attente' 
                          ? 'En attente' 
                          : 'Validée',
                        style: TextStyle(
                          fontSize: 11,
                          fontWeight: FontWeight.w500,
                          color: declaration['status'] == 'en_attente' 
                            ? Colors.orange 
                            : Colors.green,
                        ),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 12),
                const Divider(height: 1),
                const SizedBox(height: 12),
                Row(
                  children: [
                    _buildInfoChip(Icons.factory, declaration['produit']),
                    const SizedBox(width: 8),
                    _buildInfoChip(Icons.numbers, '${declaration['quantite']} tonnes'),
                    const SizedBox(width: 8),
                    _buildInfoChip(Icons.attach_money, '${declaration['valeur']} FCFA'),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildInfoChip(IconData icon, String label) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      decoration: BoxDecoration(
        color: Colors.grey[100],
        borderRadius: BorderRadius.circular(20),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 14, color: Colors.grey[600]),
          const SizedBox(width: 6),
          Text(
            label,
            style: TextStyle(fontSize: 12, color: Colors.grey[700]),
          ),
        ],
      ),
    );
  }

  void _showDetailDialog(BuildContext context, Map<String, dynamic> declaration) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      builder: (context) {
        return DraggableScrollableSheet(
          initialChildSize: 0.6,
          minChildSize: 0.5,
          maxChildSize: 0.8,
          expand: false,
          builder: (context, scrollController) {
            return Container(
              padding: const EdgeInsets.all(24),
              child: Column(
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
                  Center(
                    child: Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: declaration['status'] == 'en_attente'
                            ? Colors.orange.withOpacity(0.1)
                            : Colors.green.withOpacity(0.1),
                        shape: BoxShape.circle,
                      ),
                      child: Icon(
                        declaration['status'] == 'en_attente' 
                          ? Icons.pending 
                          : Icons.check_circle,
                        color: declaration['status'] == 'en_attente' 
                          ? Colors.orange 
                          : Colors.green,
                        size: 40,
                      ),
                    ),
                  ),
                  const SizedBox(height: 16),
                  Center(
                    child: Text(
                      declaration['title'],
                      style: const TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  const SizedBox(height: 8),
                  Center(
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                      decoration: BoxDecoration(
                        color: declaration['status'] == 'en_attente'
                            ? Colors.orange.withOpacity(0.1)
                            : Colors.green.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        declaration['status'] == 'en_attente' 
                          ? 'En attente de validation' 
                          : 'Validé par le ministère',
                        style: TextStyle(
                          fontSize: 12,
                          fontWeight: FontWeight.w500,
                          color: declaration['status'] == 'en_attente' 
                            ? Colors.orange 
                            : Colors.green,
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(height: 24),
                  const Divider(),
                  const SizedBox(height: 16),
                  Expanded(
                    child: ListView(
                      controller: scrollController,
                      children: [
                        _buildDetailRow('📦 Produit', declaration['produit']),
                        _buildDetailRow('📊 Quantité', '${declaration['quantite']} tonnes'),
                        _buildDetailRow('💰 Valeur', '${declaration['valeur']} FCFA'),
                        _buildDetailRow('📅 Date de soumission', declaration['date']),
                        _buildDetailRow('🔢 Numéro', declaration['title']),
                      ],
                    ),
                  ),
                  const SizedBox(height: 16),
                  Row(
                    children: [
                      if (declaration['status'] == 'en_attente')
                        Expanded(
                          child: OutlinedButton.icon(
                            onPressed: () {
                              Navigator.pop(context);
                              ScaffoldMessenger.of(context).showSnackBar(
                                const SnackBar(
                                  content: Text('Fonctionnalité de modification à venir'),
                                  duration: Duration(seconds: 2),
                                ),
                              );
                            },
                            icon: const Icon(Icons.edit),
                            label: const Text('Modifier'),
                            style: OutlinedButton.styleFrom(
                              padding: const EdgeInsets.symmetric(vertical: 12),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(12),
                              ),
                            ),
                          ),
                        ),
                      if (declaration['status'] == 'en_attente') const SizedBox(width: 12),
                      Expanded(
                        child: ElevatedButton(
                          onPressed: () => Navigator.pop(context),
                          style: ElevatedButton.styleFrom(
                            backgroundColor: const Color(0xFFf97316),
                            foregroundColor: Colors.white,
                            padding: const EdgeInsets.symmetric(vertical: 12),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                          child: const Text('Fermer'),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            );
          },
        );
      },
    );
  }

  Widget _buildDetailRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(
            width: 120,
            child: Text(
              label,
              style: const TextStyle(fontSize: 13, color: Colors.grey),
            ),
          ),
          Expanded(
            child: Text(
              value,
              style: const TextStyle(fontSize: 13, fontWeight: FontWeight.w500),
            ),
          ),
        ],
      ),
    );
  }

  void _showFilterDialog(BuildContext context) {
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
            children: [
              const Text(
                'Filtrer par',
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 16),
              _buildFilterOption(context, 'Toutes les déclarations', 'tous'),
              _buildFilterOption(context, 'En attente', 'en_attente'),
              _buildFilterOption(context, 'Validées', 'validees'),
            ],
          ),
        );
      },
    );
  }

  Widget _buildFilterOption(BuildContext context, String title, String filterValue) {
    return ListTile(
      leading: Icon(
        filterValue == 'tous' 
          ? Icons.list_alt 
          : filterValue == 'en_attente' 
            ? Icons.pending 
            : Icons.check_circle,
        color: filterValue == 'en_attente' 
          ? Colors.orange 
          : filterValue == 'validees' 
            ? Colors.green 
            : const Color(0xFF1a3a5c),
      ),
      title: Text(title),
      trailing: filter == filterValue 
        ? const Icon(Icons.check_circle, color: Colors.green)
        : null,
      onTap: () {
        Navigator.pop(context);
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (_) => HistoryScreen(filter: filterValue)),
        );
      },
    );
  }

  List<Map<String, dynamic>> _getDeclarations(String filter) {
    List<Map<String, dynamic>> allDeclarations = [
      {
        'title': 'Déclaration #2025001',
        'produit': 'Ciment',
        'quantite': 1000,
        'valeur': '125 000 000',
        'date': '15 janvier 2025',
        'status': 'en_attente',
      },
      {
        'title': 'Déclaration #2025002',
        'produit': 'Farine de blé',
        'quantite': 500,
        'valeur': '45 500 000',
        'date': '10 février 2025',
        'status': 'validee',
      },
      {
        'title': 'Déclaration #2025003',
        'produit': 'Textile',
        'quantite': 2000,
        'valeur': '98 750 000',
        'date': '15 mars 2025',
        'status': 'validee',
      },
      {
        'title': 'Déclaration #2025004',
        'produit': 'Huile de palme',
        'quantite': 800,
        'valeur': '28 300 000',
        'date': '5 avril 2025',
        'status': 'en_attente',
      },
    ];

    if (filter == 'en_attente') {
      return allDeclarations.where((d) => d['status'] == 'en_attente').toList();
    } else if (filter == 'validees') {
      return allDeclarations.where((d) => d['status'] == 'validee').toList();
    }
    return allDeclarations;
  }
}